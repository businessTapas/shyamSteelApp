<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{


    public function __construct()
    {
        // Sample users data
        
    }
     public function index(Request $request)
    {
        $file = 'userJson/users.json';
        if (File::exists($file)) {
            $users = json_decode(file_get_contents($file), true);
        }
        if (is_array($users)) {
            $data =  $users;

        } else {
            $data = [];
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                  ->addColumn('action', function ($row) {
                     $actionBtn = view('users.button', ['item' => $row]);
                     return $actionBtn;
                 })
                 ->rawColumns(['action']) 
                ->make(true);
        } 
        return view ('users.index');

    } 


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
             'address' => 'required',
             'gender' => 'required',
        ]);

        if ($validate->fails()) {
            $message = $validate->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            try {
                $file = 'userJson/users.json';
                if (File::exists($file)) {
                    $users = json_decode(file_get_contents($file), true);
                }
                $fullPath = null;
                if ($request->hasFile('image')) {
                  $imageName = time() . '.' . $request->file('image')->extension();
                  if (!File::exists("user_image")) {
                    File::makeDirectory("user_image");
                  }
                  $request->image->move(public_path('user_image'), $imageName);
                  $fullPath = 'user_image/' . $imageName;
                }
                $id = 1;
                // Check if $users is an array
                if (is_array($users) && !empty($users)) {
                    
                    // Get the last element of the array
                    $lastUser = end($users);

                    // Get the id of the last element
                    $lastId = $lastUser['id'];
                    $id = $lastId + 1;
                }
        
                $users[] = [
                    'id' => $id, // Auto-increment ID
                    'name' => $request->name,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'image' => $fullPath
                ];
                // Convert array to JSON and echo response
                // Save the updated users array back to the JSON file
                file_put_contents($file, json_encode($users));
                return response()->json(responseData($request->all(), "User added successfully."));

            } catch (Exception $e) {
                return response()->json('', $e->getMessage(),false);
            }
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
        $file = 'userJson/users.json';
        if (file_exists($file)) {
            $users = json_decode(file_get_contents($file), true);

            // Find the user to delete
            foreach ($users as $key => $user) {
                if ($user['id'] == $id) {
                //return $user;
                return view('users.view', compact('user'));
                }
            }
             // If user with given ID is not found
        return response()->json(['error' => 'Record not found'], 404);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = 'userJson/users.json';
            if (file_exists($file)) {
                $users = json_decode(file_get_contents($file), true);

                // Find the user to delete
                foreach ($users as $key => $user) {
                    if ($user['id'] == $id) {
                    //return $user;
                    return view('users.edit', compact('user'));
                    exit;
                    }
                }
                 // If user with given ID is not found
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
             'address' => 'required',
             'gender' => 'required',
        ]);

        if ($validate->fails()) {
            $message = $validate->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            try {

                $file = 'userJson/users.json';
                if (File::exists($file)) {
                    $users = json_decode(file_get_contents($file), true);
                }
                $fullPath = null;
                if ($request->hasFile('image')) {

                  $imageName = time() . '.' . $request->file('image')->extension();
                  if (!File::exists("user_image")) {
                    File::makeDirectory("user_image");
                  }
                  $request->image->move(public_path('user_image'), $imageName);
                  $fullPath = 'user_image/' . $imageName;
                }
               
                // Find the user to edit
                foreach ($users as  $key => $user) {
                if ($user['id'] == $request->userId) {
                    if($fullPath == null || $fullPath == '') {
                        $fullPath = $user['image'];
                    } else {
                        $path = public_path( $user['image']);

                        if (File::exists($path)) {
                            File::delete($path);
                        }
                    }
                 $users[$key] = [
                    'id' => $request->userId, // Auto-increment ID
                    'name' => $request->name,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'image' => $fullPath
                ]; 
                //return $users; exit;
          
                // Convert array to JSON and echo response
                // Save the updated users array back to the JSON file
                file_put_contents($file, json_encode($users));
                return response()->json(responseData($request->all(), "User Updated successfully."));
                exit;
            }
        }

            } catch (Exception $e) {
                return response()->json('', $e->getMessage(),false);
            }
        }
    }

    public function destroy($id)
    {
        $file = 'userJson/users.json';
            if (file_exists($file)) {
                $users = json_decode(file_get_contents($file), true);

                // Find the user to delete
                foreach ($users as $key => $user) {
                    if ($user['id'] == $id) {
                        // Remove the user from the array
                        unset($users[$key]);
                        // Re-index the array
                        $users = array_values($users);
                        // Save the updated users array back to the JSON file
                        file_put_contents($file, json_encode($users));
                        // delete the user image
                        $path = public_path( $user['image']);

                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        return response()->json(['message' => 'Record delete successfully']);

                    }
                }
            }

            // If user with given ID is not found
            return response()->json(['error' => 'Record not found'], 404);
        }
}
