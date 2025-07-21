<?php
namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'author', 'year', 'description', 'cover', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $returnType = 'array';
} 