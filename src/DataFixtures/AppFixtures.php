<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Legal;
use App\Entity\Offer;
use App\Entity\Social;
use App\Entity\SocialType;
use App\Entity\SubjectContact;
use App\Entity\User;
use App\Repository\SocialTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher, private SocialTypeRepository $socialTypeRepository)
    {
    }
    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setEmail('a@a.fr');
         $user->setRoles(['ROLE_ADMIN']);
         $user->setFirstName('a');
         $user->setLastName('a');
         $user->setAge('21');
         $user->setPicture('logo.png');
         $user->setIsVerified(1);
         $user->setIsSub(true);
         $password = $this->hasher->hashPassword($user, 'a');

         $user->setPassword($password);
         $manager->persist($user);

         $socialType = [
             "tel",
             "email",
             "url",
         ];

        foreach ($socialType as $item) {
            $type = new SocialType();
            $type->setName($item);
            $manager->persist($type);
         }

        $manager->flush();

        $socialData = [
            [
                "url" => "https://www.instagram.com/?hl=fr",
                "icon" => "2a0d02262cfa8c9a4a0f270b02df93d02927a27e.png",
                "type" => "url",
            ],
            [
                "url" => "https://twitter.com/?lang=fr",
                "icon" => "4a4ceb54b04ffd75c6cb5db4332e5b5044f116c6.png",
                "type" => "url",
            ],
            [
                "url" => "https://www.linkedin.com/home/?originalSubdomain=fr",
                "icon" => "5c9b8cbbb70e42ab76ccb6d320e9f5f0135766c5.png",
                "type" => "url",
            ],
            [
                "url" => "https://fr-fr.facebook.com/",
                "icon" => "db4e8b89dad7b10cca518e23db0156368059097f.png",
                "type" => "url",
            ],
            [
                "url" => "06 33 55 33 94",
                "icon" => "",
                "type" => "tel",
            ],
            [
                "url" => "quentin.illouz@gmail.com",
                "icon" => "",
                "type" => "tel",
            ]
        ];

        foreach ($socialData as $socialDatum) {
            $social = new Social();
            $social->setType($this->socialTypeRepository->findOneBy(['name' => $socialDatum["type"]]));
            $social->setImage($socialDatum['icon']);
            $social->setUrl($socialDatum['url']);
            $manager->persist($social);
        }

        $offer = new Offer();
        $offer->setContent("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s");
        $offer->setPrice(9.99);
        $offer->setPaimentLink("https://buy.stripe.com/test_cN2eXh7e84C26lOaEE");
        $offer->setName('start');

        $manager->persist($offer);


        $legal = new Legal();
        $legal->setContent("<h1><strong>HTML Ipsum Presents</strong></h1><div><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis.</div><h1>Header Level 2</h1><ol><li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><li>Aliquam tincidunt mauris eu risus.</li></ol><blockquote>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</blockquote><h1><strong>Header Level 3</strong></h1><ul><li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><li>Aliquam tincidunt mauris eu risus.</li></ul><div><br></div><h1><strong>HTML Ipsum Presents</strong></h1><div><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis.</div><h1>Header Level 2</h1><ol><li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><li>Aliquam tincidunt mauris eu risus.</li></ol><blockquote>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</blockquote><h1><strong>Header Level 3</strong></h1><ul><li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li><li>Aliquam tincidunt mauris eu risus.</li></ul><div><br></div>");

        $teamData = [
            [
                "firstName" => "Michel",
                "lastName" => "Doublit",
                "description" => "",
                "picture" => "63f28597de4e690a4f06eb1a634443d209859f92.png",
            ],
            [
                "firstName" => "Rachel",
                "lastName" => "oub",
                "description" => "",
                "picture" => "63f28597de4e690a4f06eb1a634443d209859f92.png",
            ],
            [
                "firstName" => "Rana",
                "lastName" => "Rub",
                "description" => "",
                "picture" => "63f28597de4e690a4f06eb1a634443d209859f92.png",
            ],
            [
                "firstName" => "Lea",
                "lastName" => "Double",
                "description" => "",
                "picture" => "63f28597de4e690a4f06eb1a634443d209859f92.png",
            ],
            [
                "firstName" => "axel",
                "lastName" => "nil",
                "description" => "",
                "picture" => "63f28597de4e690a4f06eb1a634443d209859f92.png",
            ],
        ];

        foreach ($teamData as $teamDatum) {
            $team = new Equipe();
            $team->setFisrtName($teamDatum["firstName"]);
            $team->setLastName($teamDatum["lastName"]);
            $team->setDescription($teamDatum["description"]);
            $team->setPicture($teamDatum["picture"]);
            $manager->persist($team);
        }

        $subjectRequestContact = new SubjectContact();
        $subjectRequestContact->setName('Information supplémentaire');
        $manager->persist($subjectRequestContact);


        $manager->persist($legal);
        $manager->flush();
    }
}
