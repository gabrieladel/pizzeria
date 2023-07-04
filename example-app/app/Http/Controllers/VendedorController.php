<?php
   namespace App\Http\Controllers;
   use App\Http\Controllers\Controller;
   use Illuminate\Http\Request;
   class VendedorController extends Controller
   {
       public function index(){
           return "controller vendedor";
       }
       public function show($id, $cuil, $resp, $persona){
            return view('vendedor.show' , ['vendedor' => $id, $cuil, $resp, $persona]);
       }
       /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendedor $vendedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendedor $vendedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendedor $vendedor)
    {
        //
    }
   }
