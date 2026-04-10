<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
       CREATE TABLE volumes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    alias VARCHAR(150) NOT NULL,
    name VARCHAR(150) NOT NULL,

    status TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1:active,0:inactive',

    created_by BIGINT UNSIGNED DEFAULT NULL,

    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    -- Indexes
    UNIQUE INDEX uniq_alias (alias),
    INDEX idx_status (status)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
    }

    public function down()
    {
        Schema::dropIfExists('volumes');
    }
};
