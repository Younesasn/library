<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookFormType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig');
    }

    #[Route('/book', name: 'app_book_show')]
    public function show(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findByCreatedBy($this->getUser());

        return $this->render('book/show.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/book/new', name: 'app_book_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $book = new Book();
            $book->setTitle($form->get('title')->getData())
                ->setAuthor($form->get('author')->getData())
                ->setDescription($form->get('description')->getData())
                ->setCreatedBy($this->getUser())
                ->setCreatedAt(new \DateTime());
            $entityManager->persist($book);
            $entityManager->flush();
            $this->addFlash('indigo', 'Livre ajouté !');
            return $this->redirectToRoute('app_book_show');
        }

        return $this->render('book/new.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/book/{id}/delete', name: 'app_book_delete')]
    public function delete(Book $book, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($book);
        $entityManager->flush();
        $this->addFlash('indigo', 'Livre supprimé !');
        return $this->redirectToRoute('app_book_show');
    }
}
