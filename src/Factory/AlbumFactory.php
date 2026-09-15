<?php

namespace App\Factory;

use App\Entity\Album;
use App\Enum\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentObjectFactory<Album>
 */
final class AlbumFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]
    public static function class(): string
    {
        return Album::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'artist' => ArtistFactory::random(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'picture' => self::faker()->text(255),
            'releaseDate' => self::faker()->dateTime(),
            'title' => self::faker()->sentence(2),
            'type' => self::faker()->randomElement(AlbumType::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Album $album): void {})
        ;
    }
}
