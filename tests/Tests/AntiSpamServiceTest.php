<?php

namespace App\Tests\Service;

use App\Entity\Post;
use App\Service\AntiSpamService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AntiSpamServiceTest extends KernelTestCase
{
    public function getAntiSpam()
    {
        $container = static::getContainer();

        $antispam = $container->get(AntiSpamService::class);
        return $antispam;
    }

    /**
     * @dataProvider postDataProvider
     */
    public function testPostIsValid($content, $public, $expectedResult): void
    {
        $kernel = self::bootKernel();
        $post = new Post();
        $post->setContent($content);
        $post->setPublic($public);
        self::assertSame($expectedResult, $this->getAntiSpam()->verify($post));
    }

    public function postDataProvider()
    {
        return [
            [
                'lorem ipsum dolor sit amet', 
                'le fan club ',
                true,
            ],
            [
                'lorem ipsum dolor sit merde',
                'le fan club ',
                false,
            ],
            
            [
                'il était une fois la vie merde d\'alès',
                'le fan club merde',
                false,
            ],
            [
                'il était une fois la vie d\'alès',
                'le fan club merde',
                false,
            ],
        ];
    }
}
