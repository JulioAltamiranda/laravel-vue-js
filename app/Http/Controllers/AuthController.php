<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /** metodo para loguear a un usuario
     * 
     * @return response 
     * @param Request
     */
    public function sigIn(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user=User::whereEmail($request->email)->first();
            Auth::login($user);
            return response()->json(['message' => 'login!'], 200);
        }
        return response()->json(['message' => 'Incorrect username or password.'], 422);
    }


    /** metodo para cerrar la sesion de un usuario
     * 
     * @return redirect 
     * @param Product
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    /** metodo para registrar a un usuario
     * 
     * @return response 
     * @param Request
     */
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');
        
        if (!User::whereEmail($request->email)->first()) {
            $credentials['password'] = bcrypt($request->password);
            $user = User::create($credentials);
            Auth::login($user);
            return response()->json(['message' => 'registered!'], 200); 
        }
        return response()->json(['message' => 'there is already a user with that email'], 422);
        
        
    }
}
