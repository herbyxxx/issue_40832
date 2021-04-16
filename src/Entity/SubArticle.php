<?php

namespace App\Entity;

use App\Repository\SubArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubArticleRepository::class)
 */
class SubArticle extends Article
{

}