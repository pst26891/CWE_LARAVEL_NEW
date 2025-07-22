<p>Dear Editor,</p>
<p>A new manuscript submission has been received from an author with the following details and attached files:</p>

<table rules="all" style="border-color: #666; border-collapse: collapse; width: 100%;" cellpadding="10" border="1">
    <tr style='background: #eee;'>
        <td><strong>Corresponding Author Name:</strong></td>
        <td>{{ $corr_author_fname ?? '' }} {{ $corr_author_mname ?? '' }} {{ $corr_author_lname ?? '' }}</td>
    </tr>
    <tr>
        <td><strong>Email:</strong></td>
        <td>{{ $corr_author_email ?? '' }}</td>
    </tr>
    <tr>
        <td><strong>Contact Number:</strong></td>
        <td>{{ $corr_author_contact ?? '' }}</td>
    </tr>
    <tr>
        <td><strong>Manuscript Title:</strong></td>
        <td>{{ $article_title ?? '' }}</td>
    </tr>
    <tr>
        <td><strong>Uploaded Files:</strong></td>
        <td>
            <ul>
                @if(!empty($uploaded_files))
                    @foreach ($uploaded_files as $file)
                        <li>{{ $file }}</li>
                    @endforeach
                @else
                    <li>No files uploaded</li>
                @endif
            </ul>
        </td>
    </tr>
</table>

<p>Thanks & Regards,<br/>CWE Journal</p>
