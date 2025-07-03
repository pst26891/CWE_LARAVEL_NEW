<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Article;
use App\Models\Admin\Volume;
use App\Models\Admin\ArticleType;
use App\Services\FileUploadService;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

use App\Models\Admin\Issue;
use App\Models\Admin\Page;
use App\Models\Admin\Setting;
use App\Models\Admin\Affiliation;

use Illuminate\Support\Facades\Auth;



class ArticlesController extends MyController
{
  protected $repository;
  private $__perPage = 20;

  public function __construct()
  {
    
  }

  public function index()
  {
    $data['mlists'] = Article::with('volume', 'issue')->latest()->paginate($this->__perPage);

    $data['volumes'] = Volume::pluck('name', 'id');
    return $this->adminView('admin.article.index', $data, true, $this->__perPage);
  }


  public function search(Request $request)
  {

    $filter = array(['articles.id', '!=', '0']);

    if (!empty($request)) {
      if (isset($request->sname) && !empty($request->sname)) {
        $filter[] = array('title', 'like', '%' . $request->sname . '%');
      }

      if (isset($request->volumes) && $request->volumes != '') {
        $filter[] = array('volume', '=', $request->volumes);
      }

      if (isset($request->issue) && $request->issue != '') {
        $filter[] = array('number', '=', $request->issue);
      }

      if (isset($request->status)) {
        $filter[] = array('articles.status', '=', $request->status);
      }

      if (isset($request->pageshow)) {
        $this->__perPage = $request->pageshow;
      }
    }
    // $data['mlists'] = Article::latest()->where($filter)->paginate($this->__perPage); 
    $data['mlists'] = DB::table('articles')
      ->join('volumes as vlm', 'vlm.id', '=', 'articles.volume')
      ->join('volumes as iss', 'iss.id', '=', 'articles.number')
      ->where($filter)
      ->select('articles.manuscript_no', 'articles.id', 'articles.status', 'articles.title', 'articles.date', 'iss.name as issue_name', 'vlm.name as volume_name')
      ->orderBy('articles.id', 'DESC')
      ->paginate($this->__perPage);

    $data['mlists']->appends($request->all());

    // $quries = DB::getQueryLog();
    // echo "<pre>"; print_r($quries); exit;


    $data['volumes'] = Volume::getSelectData('name');

    $paginate = true;
    echo $this->admin_view('admin.article.index', $data, $paginate, $this->__perPage);
  }


  public function create()
  {
    $data['pages'] = Page::pluck('title', 'id');
    $data['articleTypes'] = ArticleType::pluck('name', 'id');
    $data['volumes'] = Volume::pluck('name', 'id');
    $data['issues'] = array();


    return $this->adminView('admin.article.create', $data);
  }

  public function store(StoreArticleRequest $request)
  {
        $filePath = null;

   
    if ($request->hasFile('upload_pdf')) {
      $filePath = FileUploadService::uploadPdf($request->file('upload_pdf'), $request->volume, $request->number);
    }

    $manuscript = $this->generateManuscriptNumber();

    DB::transaction(function () use ($request, $manuscript, $filePath, &$article) {
      $article = Article::create(array_merge($request->validated(), [
          'url' => Str::slug($request->title),
          'category' => $request->category,
          'manuscript_no' => $manuscript,
          'date' => date('Y-m-d'),
          'view' => $request->view,
          'download' => $request->download,
          'doi' => $request->doi,
          'article_citation' => $request->article_citation,
          'url_citation' => $request->url_citation,
          'ama' => $request->ama,
          'apa' => $request->apa,
          'mla' => $request->mla,
          'chicago' => $request->chicago,
          'page_no' => $request->page_no,
          'recieved' => $request->recieved, // Possible typo: 'received'?
          'accepted' => $request->accepted,
          'pub_date_o' => $request->pub_date_o,
          'pub_date_p' => $request->pub_date_p,
          'pdf_locate' => isset($folder) ? $folder : '',
          'publisher_name' => $request->publisher_name,
          'plagrism_check_date' => $request->plagrism_check_date, // Possible typo: 'plagiarism_check_date'?
          'final_approval_date' => $request->final_approval_date,
          'final_approval_by' => $request->final_approval_by,
          'final_link' => $request->final_link,
          'first_reviewer' => $request->first_reviewer,
          'second_reviewer' => $request->second_reviewer,
          'first_rev_email' => $request->first_rev_email,
          'first_rev_orcid_id' => $request->first_rev_orcid_id,
          'sec_rev_orcid_id' => $request->sec_rev_orcid_id,
          'first_rev_publons' => $request->first_rev_publons,
          'sec_rev_publons' => $request->sec_rev_publons,
          'meta_keyword' => $request->meta_keyword,
          'meta_description' => $request->meta_description,
          'order_no' => 0,
          'created_by' => Auth::id(),
          'pdf_download_link' => $request->pdf_download_link

      ]));

      $authors = collect($request->f_name)->map(function ($name, $i) use ($request, $manuscript,$article) {
          return [
              'manuscript_no' => $manuscript,
              'article_id' => $article->id,
              'f_name' => $name,
              'm_name' => $request->m_name[$i] ?? null,
              'l_name' => $request->l_name[$i] ?? null,
              'affiliation' => $request->affiliation[$i] ?? null,
              'email' => $request->email[$i] ?? null,
              'orcid_id' => $request->orcid_id[$i] ?? null,
              'correspond_author' => $request->correspond_author[$i + 1] ?? null,
              'status' => 1,
              'order_no' => $i + 1,
          ];
      });

      DB::table('authors')->insert($authors->toArray());
     
      $affiliations = [];

      if (!empty($request->aid) && is_array($request->aid)) {
          foreach ($request->aid as $index => $aid) {
              $aff_full_name = implode(', ', array_filter([
                  $request->department[$index] ?? '',
                  $request->inst_address[$index] ?? '',
                  $request->inst_name[$index] ?? '',
                  $request->inst_city[$index] ?? '',
                  $request->pincode[$index] ?? '',
                  $request->state[$index] ?? '',
                  $request->country[$index] ?? '',
                  $request->fax[$index] ?? '',
                  $request->mobile[$index] ?? '',
                  $request->inst_tel[$index] ?? ''
              ]));
      
              $affiliations[] = [
                  'manuscript_no' => $manuscript,
                  'article_id' => $article->id,
                  'department' => $request->department[$index] ?? '',
                  'inst_address' => $request->inst_address[$index] ?? '',
                  'inst_name' => $request->inst_name[$index] ?? '',
                  'inst_city' => $request->inst_city[$index] ?? '',
                  'pincode' => $request->pincode[$index] ?? '',
                  'state' => $request->state[$index] ?? '',
                  'country' => $request->country[$index] ?? '',
                  'fax' => $request->fax[$index] ?? '',
                  'mobile' => $request->mobile[$index] ?? '',
                  'inst_tel' => $request->inst_tel[$index] ?? '',
                  'author_no' => "aff00" . ($index + 1),
                  'full_name' => $aff_full_name
              ];
          }
      }
      DB::table('affiliations')->insert($affiliations);
  });
    return redirect('admin/articles')->with('success', 'Article has been Updated successfully');
  }

  public function issueByVolume(Request $request)
  {

    $parentId = $request->volume_id;

    $issue = Issue::where('volume_id', $parentId)->get();
    return response()->json([
      'issues' => $issue
    ]);
  }

  public function updateItems(Request $request)
  {
    $input = $request->all();

    if (count($input['pending']) > 0) {
      foreach ($input['pending'] as $key => $value) {
        $key = $key + 1;
        Article::where('id', $value)
          ->update([
            'order_no' => $key
          ]);
      }
    }

    return response()->json(['status' => 'success']);
  }


  public function uploadImage(Request $request)
  {

    if ($request->hasFile('upload')) {
      $uploadedFile = $request->file('upload');

      // Generate unique filename
      $filename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
      $extension = $uploadedFile->getClientOriginalExtension();
      $filename = $filename . '_' . uniqid() . '.' . $extension;

      // Move uploaded file to destination folder
      $uploadedFile->move(public_path('ckfinder/userfiles/files/'), $filename);

      // Generate URL for the uploaded file
      $url = asset('ckfinder/userfiles/files/' . $filename);



      // Return JSON response with uploaded file details
      return response()->json([
        'filename' => $filename,
        'uploaded' => true,
        'url' => $url
      ]);
    }

    // Return JSON response indicating no file was uploaded
    return response()->json([
      'uploaded' => false,
      'error' => 'No file uploaded'
    ]);
  }
  private function generateManuscriptNumber()
  {
      $count = Article::max('id') + 1;
      $settings = Setting::first();
      return $settings->journal_short_name . "/{$count}/" . date('Y');

  }

  public function edit($id)
  {

      $data = [
          'article' => Article::with('author', 'affiliation')->findOrFail($id),
          'articleTypes' => ArticleType::pluck('name', 'id'),
          'volumes' => Volume::pluck('name', 'id'),
          'issues' => Issue::pluck('name', 'id'),
      ];

      return $this->adminView('admin.article.edit', $data);

  }

  public function update(UpdateArticleRequest $request, $id)
{

    $article = Article::with('author', 'affiliation')->findOrFail($id);

    $filePath = $article->pdf_locate;

    if ($request->hasFile('upload_pdf')) {
        $filePath = FileUploadService::uploadPdf($request->file('upload_pdf'), $request->volume, $request->number);
    }

    DB::transaction(function () use ($request, $article, $filePath) {
        $article->update(array_merge($request->validated(), [
            'url' => Str::slug($request->title),
            'category' => $request->category,
            'date' => date('Y-m-d'),
            'view' => $request->view,
            'download' => $request->download,
            'doi' => $request->doi,
            'article_citation' => $request->article_citation,
            'url_citation' => $request->url_citation,
            'ama' => $request->ama,
            'apa' => $request->apa,
            'mla' => $request->mla,
            'chicago' => $request->chicago,
            'page_no' => $request->page_no,
            'received' => $request->received, // Possible typo: 'received'?
            'accepted' => $request->accepted,
            'pub_date_o' => $request->pub_date_o,
            'pub_date_p' => $request->pub_date_p,
            'pdf_locate' => $filePath,
            'publisher_name' => $request->publisher_name,
            'plagrism_check_date' => $request->plagrism_check_date, // Possible typo: 'plagiarism_check_date'?
            'final_approval_date' => $request->final_approval_date,
            'final_approval_by' => $request->final_approval_by,
            'final_link' => $request->final_link,
            'first_reviewer' => $request->first_reviewer,
            'second_reviewer' => $request->second_reviewer,
            'first_rev_email' => $request->first_rev_email,
            'first_rev_orcid_id' => $request->first_rev_orcid_id,
            'sec_rev_orcid_id' => $request->sec_rev_orcid_id,
            'first_rev_publons' => $request->first_rev_publons,
            'sec_rev_publons' => $request->sec_rev_publons,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'updated_by' => Auth::id(),
            'pdf_download_link' => $request->pdf_download_link
        ]));

        $article->author()->delete();
        $authors = collect($request->f_name)->map(function ($name, $i) use ($request, $article) {
          if (!empty($name)) {
              return [
                  'manuscript_no' => $article->manuscript_no ?? '',
                  'article_id' => $article->id ?? '',
                  'f_name' => $name,
                  'm_name' => $request->m_name[$i] ?? '',
                  'l_name' => $request->l_name[$i] ?? '',
                  'affiliation' => $request->affiliation[$i] ?? '',
                  'email' => $request->email[$i] ?? '',
                  'orcid_id' => $request->orcid_id[$i] ?? '',
                  'correspond_author' => isset($request->correspond_author[$i]) ? $request->correspond_author[$i] : 'No',
                  'status' => 1,
                  'order_no' => $i + 1,
              ];
          }
      })->filter(); // Remove null values to prevent inserting empty rows
      
      // Insert only if authors exist
      if ($authors->isNotEmpty()) {
          DB::table('authors')->insert($authors->toArray());
      }
      

        $article->affiliation()->delete();
        $affiliations = collect($request->aid)->map(function ($aid, $index) use ($request, $article) {
          if (
              !empty($request->inst_name[$index]) || 
              !empty($request->department[$index])
          ) {
              // Ensure all values exist before accessing them
              $aff_full_name = implode(', ', array_filter([
                  $request->department[$index] ?? '',
                  $request->inst_address[$index] ?? '',
                  $request->inst_name[$index] ?? '',
                  $request->inst_city[$index] ?? '',
                  $request->pincode[$index] ?? '',
                  $request->state[$index] ?? '',
                  $request->country[$index] ?? '',
                  $request->fax[$index] ?? '',
                  $request->mobile[$index] ?? '',
                  $request->inst_tel[$index] ?? ''
              ], 'strlen')); // This ensures empty values are removed properly
      
              return [
                  'manuscript_no' => $article->manuscript_no ?? '',
                  'article_id' => $article->id ?? '',
                  'department' => $request->department[$index] ?? '',
                  'inst_address' => $request->inst_address[$index] ?? '',
                  'inst_name' => $request->inst_name[$index] ?? '',
                  'inst_city' => $request->inst_city[$index] ?? '',
                  'pincode' => $request->pincode[$index] ?? '',
                  'state' => $request->state[$index] ?? '',
                  'country' => $request->country[$index] ?? '',
                  'fax' => $request->fax[$index] ?? '',
                  'mobile' => $request->mobile[$index] ?? '',
                  'inst_tel' => $request->inst_tel[$index] ?? '',
                  'author_no' => "aff00" . ($index + 1),
                  'full_name' => $aff_full_name
              ];
          }
      })->filter(); // Remove null values to avoid inserting empty rows
      
      // Insert into the database
      if ($affiliations->isNotEmpty()) {
          DB::table('affiliations')->insert($affiliations->toArray());
      }
      
     
    });

    return redirect('admin/articles')->with('success', 'Article has been Updated successfully');
}
  
}
