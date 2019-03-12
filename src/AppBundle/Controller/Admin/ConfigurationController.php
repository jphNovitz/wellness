<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Meta;
use AppBundle\Form\Type\MetaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ConfigurationController extends AbstractController {

    protected $serializer ;

    public function __construct()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @Route("/admin/configuration/", name="admin_config")
     */
    public function indexAction(Request $request)
    {
        $filesystem = new Filesystem();  // initialize filesystem
        $root = $this->get('kernel')->getProjectDir();

        // veriffy that meta.json exist, if not create it
        if ($filesystem->exists($root.'/File/meta.json')){
            $content = file_get_contents($root.'/File/meta.json');
            $meta = $this->serializer->deserialize($content, meta::class, 'json');
        } else {
            $meta = new Meta();
            $meta_serialized = $this->serializer->serialize($meta, 'json');
            $filesystem->dumpFile($root.'/File/meta.json', $meta_serialized);
        }

        $form_meta = $this->createForm(MetaType::class, $meta);

        $form_meta->handleRequest($request);

        if ($form_meta->isSubmitted() && $form_meta->isValid()){
            try{
                $meta_serialized = $this->serializer->serialize($meta, 'json');
                $filesystem->dumpFile($root.'/File/meta.json', $meta_serialized);
                $this->addFlash('succes', 'mets tag modifiés');
            } catch (\Exception $e){
                $this->addFlash('error', 'erreur');
            }

        }

        return $this->render('admin/Configuration/configuration.html.twig', [
            'form_meta' => $form_meta->createView()
        ]);
    }
}