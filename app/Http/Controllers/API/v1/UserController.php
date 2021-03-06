<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\MessagesApi;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os users cadastrados na base de dados
    public function getAll()
    {
        $users = User::all();

        return response()->json($users, 200);
    }

    public function getById($idUser)
    {

        $user = User::where('id', $idUser)->first();
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function update(Request $request, int $id)
    {
        //
        $users = $this->users->find($id);

        if ($users != null) {
            try {

                $this->checkdata($request);

                $requestData = $request->all();

                $requestData['password'] = Hash::make($requestData['password']);

                $users->update($requestData);

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::EDITED_SUCESS), 200);
            } catch (ValidationException $e) {


                return response()->json(array('código' => 400, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
            }
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function checkdata($request)
    {

        if ($request->name == null) {
            throw new ValidationException();
        }

        if ($request->password == null) {
            throw new ValidationException();
        }

        if ($request->email == null) {
            throw new ValidationException();
        }
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->checkdata($request);

            $requestData = $request->all();

            $requestData['password'] = Hash::make($requestData['password']);

            $this->users->create($requestData);

            return response()->json(array('código' => 200, 'descrição' => MessagesApi::CREATED_SUCESS), 200);
        } catch (ValidationException $e) {

            return response()->json(array('código' => 400, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $users = $this->users->find($id);

        if ($users != null) {
            $delete = $users->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }
}
