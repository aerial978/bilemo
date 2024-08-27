<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CustomController extends AbstractController
{
    private $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Request $request)
    {
        $page = (int) $request->query->get('page', 1);

        return $this->userRepository->findUsersByClientWithPagination($page);
    }
}
