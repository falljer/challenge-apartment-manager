<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Http\Requests\ApartmentCreateRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Http\Resources\ApartmentCollection;
use App\Http\Resources\Apartment as ApartmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $result = new ApartmentCollection(Apartment::all());
        return response($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ApartmentCreateRequest  $request
     * @return Response
     */
    public function store(ApartmentCreateRequest $request)
    {
        $apartment = new Apartment();
        $apartment->name = $request->name;
        $apartment->description = $request->description;
        $apartment->floor_area_size = $request->floor_area_size;
        $apartment->price_per_month = $request->price_per_month;
        $apartment->number_of_rooms = $request->number_of_rooms;
        $apartment->latitude = $request->latitude;
        $apartment->longitude = $request->longitude;
        $apartment->realtor_id = $request->realtor_id;
        $apartment->save();
        return response([
            'status' => 'success',
            'data' => $apartment
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $result = new ApartmentResource(Apartment::find($id));
        return response($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ApartmentUpdateRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ApartmentUpdateRequest $request, $id)
    {
        $apartment = Apartment::find($id);
        $apartment->name = $request->name;
        $apartment->description = $request->description;
        $apartment->floor_area_size = $request->floor_area_size;
        $apartment->price_per_month = $request->price_per_month;
        $apartment->number_of_rooms = $request->number_of_rooms;
        $apartment->latitude = $request->latitude;
        $apartment->longitude = $request->longitude;
        $apartment->realtor_id = $request->realtor_id;
        $apartment->save();
        return response([
            'status' => 'success',
            'data' => $apartment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        $apartment->delete();
        return response([
            'status' => 'success'
        ], 204);
    }
}
