<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\User;
use App\Form\UserType;


/**
 *  User controller.
 * @Route("/api", name="api_")
 */
class UserController extends FOSRestController
{

    /**
     * List all users.
     * @Rest\Get("/users")
     *
     * @return Response
     */
    public function getUsersAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $userIds = json_decode($request->getContent(), true);
        $user = $repository->find($userIds['id']);
        return $this->handleView($this->view($user));
    }

    /**
     * Create a user.
     * @Rest\Post("/user")
     *
     * @return Response
     */

    public function postUserAction(Request $request)
    {
        $user = New User();
        $form = $this->createForm(UserType::class, $user);
        $data = json_decode($request->getContent(), true);
        $date = new \DateTime(date(date("Y-m-d H:i:s")));
        $data['created_at'] = $date;
        $data['updated_at'] = $date;
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }

    /**
     * Delete a user.
     * @Rest\Delete("/user/delete")
     *
     * @return Response
     */
    public function deleteUserAction(Request $request)
    {
        $user = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $userDelete = $em->getRepository(User::class)->find($user['id']);
        if (!empty($userDelete)) {
            $em->remove($userDelete);
            $em->flush();
            return $this->handleView($this->view(['status' => 'Delete'], Response::HTTP_CREATED));

        }
        return $this->handleView($this->view('Error in delete action'));

    }

    /**
     * Update a user.
     * @Rest\Put("/user/edit")
     *
     * @return Response
     */
    public function updateUserAction(Request $request)
    {

        $user = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $userUpdate = $em->getRepository(User::class)->find($user['id']);
        if (!empty($userUpdate)) {
            $date = new \DateTime(date(date("Y-m-d H:i:s")));

            $userUpdate->setUpdatedAt($date);
            $userUpdate->updateObject($user);

            $em->flush();

            return $this->handleView($this->view(['status' => 'Update'], Response::HTTP_CREATED));

        }
        return $this->handleView($this->view(['status' => 'update'], Response::HTTP_CREATED));

    }
}
