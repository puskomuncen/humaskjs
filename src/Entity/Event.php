<?php

namespace PHPMaker2025\humaskerjasama\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2025\humaskerjasama\AdvancedUserInterface;
use PHPMaker2025\humaskerjasama\AbstractEntity;
use PHPMaker2025\humaskerjasama\AdvancedSecurity;
use PHPMaker2025\humaskerjasama\UserProfile;
use PHPMaker2025\humaskerjasama\UserRepository;
use function PHPMaker2025\humaskerjasama\Config;
use function PHPMaker2025\humaskerjasama\EntityManager;
use function PHPMaker2025\humaskerjasama\RemoveXss;
use function PHPMaker2025\humaskerjasama\HtmlDecode;
use function PHPMaker2025\humaskerjasama\HashPassword;
use function PHPMaker2025\humaskerjasama\Security;

/**
 * Entity class for "event" table
 */

#[Entity]
#[Table("event", options: ["dbId" => "DB"])]
class Event extends AbstractEntity
{
    #[Id]
    #[Column(name: "event_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $EventId;

    #[Column(name: "nama_event", type: "string")]
    private string $NamaEvent;

    #[Column(name: "deskripsi", type: "text", nullable: true)]
    private ?string $Deskripsi;

    #[Column(name: "tanggal_mulai", type: "datetime")]
    private DateTime $TanggalMulai;

    #[Column(name: "tanggal_selesai", type: "datetime")]
    private DateTime $TanggalSelesai;

    #[Column(name: "lokasi", type: "string", nullable: true)]
    private ?string $Lokasi;

    #[Column(name: "mitra_id", type: "integer", nullable: true)]
    private ?int $MitraId;

    #[Column(name: "peserta_terdaftar", type: "integer", nullable: true)]
    private ?int $PesertaTerdaftar;

    public function __construct()
    {
        $this->PesertaTerdaftar = 0;
    }

    public function getEventId(): int
    {
        return $this->EventId;
    }

    public function setEventId(int $value): static
    {
        $this->EventId = $value;
        return $this;
    }

    public function getNamaEvent(): string
    {
        return HtmlDecode($this->NamaEvent);
    }

    public function setNamaEvent(string $value): static
    {
        $this->NamaEvent = RemoveXss($value);
        return $this;
    }

    public function getDeskripsi(): ?string
    {
        return HtmlDecode($this->Deskripsi);
    }

    public function setDeskripsi(?string $value): static
    {
        $this->Deskripsi = RemoveXss($value);
        return $this;
    }

    public function getTanggalMulai(): DateTime
    {
        return $this->TanggalMulai;
    }

    public function setTanggalMulai(DateTime $value): static
    {
        $this->TanggalMulai = $value;
        return $this;
    }

    public function getTanggalSelesai(): DateTime
    {
        return $this->TanggalSelesai;
    }

    public function setTanggalSelesai(DateTime $value): static
    {
        $this->TanggalSelesai = $value;
        return $this;
    }

    public function getLokasi(): ?string
    {
        return HtmlDecode($this->Lokasi);
    }

    public function setLokasi(?string $value): static
    {
        $this->Lokasi = RemoveXss($value);
        return $this;
    }

    public function getMitraId(): ?int
    {
        return $this->MitraId;
    }

    public function setMitraId(?int $value): static
    {
        $this->MitraId = $value;
        return $this;
    }

    public function getPesertaTerdaftar(): ?int
    {
        return $this->PesertaTerdaftar;
    }

    public function setPesertaTerdaftar(?int $value): static
    {
        $this->PesertaTerdaftar = $value;
        return $this;
    }
}
