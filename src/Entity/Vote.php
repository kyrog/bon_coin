<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vote_up;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vote_down;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="votes")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Article::class, inversedBy="vote", cascade={"persist", "remove"})
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoteUp(): ?int
    {
        return $this->vote_up;
    }

    public function setVoteUp(?int $vote_up): self
    {
        $this->vote_up = $vote_up;

        return $this;
    }

    public function getVoteDown(): ?int
    {
        return $this->vote_down;
    }

    public function setVoteDown(?int $vote_down): self
    {
        $this->vote_down = $vote_down;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
