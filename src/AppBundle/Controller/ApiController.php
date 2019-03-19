<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
     /**
     * @Route("/listarCategorias", methods={"GET"})
     */
    public function listaCategoriasAction()
    {
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repository->findAll();
        return new JsonResponse($this->catsToArray($categorias));
    }

    /**
     * @Route("/insertarCategoria/{nombre}/{descripcion}", methods={"POST"})
     */
    public function insertarCategoriaAction($nombre="", $descripcion="")
    {
        if(strlen($nombre) > 0){
            $categoria = new Categoria();
            $categoria->setNombre($nombre);
            $categoria->setDescripcion($descripcion);
            $categoria->setFoto("");
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            return new JsonResponse($this->catToArray($categoria));
        }
       
        throw new BadRequestHttpException('Falta nombre', null, 400);     
    }

    private function catToArray($categoria) {
        $categoriaArray = array();
        $categoriaArray["id"] = $categoria->getId();
        $categoriaArray["nombre"] = $categoria->getNombre();
        $categoriaArray["descripcion"] = $categoria->getDescripcion();
        return $categoriaArray;
    }

    private function catsToArray($categorias) {
        $categoriasArray = array();
        foreach ($categorias as $categoria) {
           $categoriasArray[] = $this->catToArray($categoria);

        }
        return $categoriasArray;
    }

    /**
     * @Route("/listarIngredientes", methods={"GET"})
     */
    public function listaIngredientesAction()
    {
        $repository = $this->getDoctrine()->getRepository(Ingrediente::class);
        $ingredientes = $repository->findAll();
        return new JsonResponse($this->ingredsToArray($ingredientes));
    }

    /**
     * @Route("/insertarIngrediente/{nombre}", methods={"POST"})
     */
    public function insertarIngredienteAction($nombre="")
    {
        if(strlen($nombre) > 0){
            $ingrediente = new Ingrediente();
            $ingrediente->setNombre($nombre);
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingrediente);
            $em->flush();
            return new JsonResponse($this->ingreToArray($ingrediente));
        }
       
        throw new BadRequestHttpException('Falta nombre', null, 400);     
    }

    private function ingreToArray($ingrediente) {
        $ingredienteArray = array();
        $ingredienteArray["id"] = $ingrediente->getId();
        $ingredienteArray["nombre"] = $ingrediente->getNombre();
        return $ingredienteArray;
    }

    private function ingredsToArray($ingredientes) {
        $ingredientesArray = array();
        foreach ($ingredientes as $ingrediente) {
           $ingredientesArray[] = $this->ingreToArray($ingrediente);

        }
        return $ingredientesArray;
    }

}