<?php
namespace App\Service;

use App\Entity\PostImage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;
    private $entityManager;

    public function __construct(
        $targetDirectory, 
        SluggerInterface $slugger
    )
    {
        $this->targetDirectory  = $targetDirectory;
        $this->slugger          = $slugger;
    }

    public function upload(UploadedFile $file): array
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->getContent();
            $postImage = new PostImage();
            $postImage->setImage($file->getContent());
            //$this->entityManager->persist($postImage);
            //$this->entityManager->flush();
            @unlink($file->getPath() . '/' . $fileName);
            return [$postImage];
            //$file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            die($e->getMessage());
            // ... handle exception if something happens during file upload
        }

        return [];
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}