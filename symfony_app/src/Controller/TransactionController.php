<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/transaction", name="api_transaction_")
 */
class TransactionController extends AbstractController
{
    private $serializer;
    private $transactionRepository;
    private $userRepository;

    public function __construct(
        SerializerInterface $serializerInterface, 
        TransactionRepository $transactionRepository,
        UserRepository $userRepository)
    {
        $this->serializer = $serializerInterface;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/", name="browse", methods={"POST"})
     */
    public function browse(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            if($data) {
                if($this->userRepository->find($data['user'])) {
                    $transactions = $this->transactionRepository->findAllByUser($data['user']);
                    return $this->json($this->serializer->normalize($transactions, null, ['groups' => ['transaction', 'transaction-relation', 'user', 'category']]));
                }
                throw $this->createNotFoundException('The user does not exist');
            }
            return new Response('Request can not be empty', Response::HTTP_BAD_REQUEST);
        } catch (\Error $e) {
            error_log("Error caught: " . $e->getMessage());
     }
    }
}
