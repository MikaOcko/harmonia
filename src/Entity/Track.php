<?php

namespace App\Entity;

use App\Repository\TrackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackRepository::class)]
class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column]
    private ?int $listeningCounter = null;

    #[ORM\Column]
    private ?bool $isExplicitContent = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\ManyToMany(targetEntity: Playlist::class, inversedBy: 'favorites')]
    private Collection $playlists;

    /**
     * @var Collection<int, Favorite>
     */
    #[ORM\OneToMany(targetEntity: Favorite::class, mappedBy: 'track')]
    private Collection $favorites;

    /**
     * @var Collection<int, ListeningLog>
     */
    #[ORM\OneToMany(targetEntity: ListeningLog::class, mappedBy: 'track')]
    private Collection $listeningLogs;

    /**
     * @var Collection<int, Style>
     */
    #[ORM\ManyToMany(targetEntity: Style::class, inversedBy: 'tracks')]
    private Collection $styles;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Album $album = null;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->listeningLogs = new ArrayCollection();
        $this->styles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getListeningCounter(): ?int
    {
        return $this->listeningCounter;
    }

    public function setListeningCounter(int $listeningCounter): static
    {
        $this->listeningCounter = $listeningCounter;

        return $this;
    }

    public function isExplicitContent(): ?bool
    {
        return $this->isExplicitContent;
    }

    public function setIsExplicitContent(bool $isExplicitContent): static
    {
        $this->isExplicitContent = $isExplicitContent;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        $this->playlists->removeElement($playlist);

        return $this;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setTrack($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getTrack() === $this) {
                $favorite->setTrack(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ListeningLog>
     */
    public function getListeningLogs(): Collection
    {
        return $this->listeningLogs;
    }

    public function addListeningLog(ListeningLog $listeningLog): static
    {
        if (!$this->listeningLogs->contains($listeningLog)) {
            $this->listeningLogs->add($listeningLog);
            $listeningLog->setTrack($this);
        }

        return $this;
    }

    public function removeListeningLog(ListeningLog $listeningLog): static
    {
        if ($this->listeningLogs->removeElement($listeningLog)) {
            // set the owning side to null (unless already changed)
            if ($listeningLog->getTrack() === $this) {
                $listeningLog->setTrack(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->styles->contains($style)) {
            $this->styles->add($style);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        $this->styles->removeElement($style);

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

        return $this;
    }
}
