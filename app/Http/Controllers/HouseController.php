<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HouseController extends Controller
{
    //
    function showAddHouseForm()
    {
        return view('pages.dashboard.add-house');
    }
    function createHouse(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'house_name' => 'required|string',
                'area' => 'required|string',
                'price' => 'required|integer',
                'type' => 'required|string',
                'rooms' => 'required|integer',
                // 'image_urls.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the allowed file types and size
                'province' => 'required|string',
                'district' => 'required|string',
                'sector' => 'required|string',
                'cell' => 'required|string',
                'village' => 'required|string',
                'house_description' => 'nullable|string',
            ]);

            // Process the form data and create a new house
            $house = new House();
            $house->house_name = $request->input('house_name');
            $house->area = $request->input('area');
            $house->price = $request->input('price');
            $house->type = $request->input('type');
            $house->rooms = $request->input('rooms');

            // Handle file upload and store images in the storage disk
            $imageUrls = [];
            if ($request->hasFile('image_urls')) {
                foreach ($request->file('image_urls') as $index => $image) {
                    // Validate each image individually
                    $request->validate([
                        'image_urls.' . $index => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('images', $imageName, 'public'); // Store image in the 'public' disk under the 'images' directory
                    $imageUrls[] = 'storage/images/' . $imageName;
                }
            }
            $house->image_urls = json_encode($imageUrls); // Convert the array to JSON

            // Address information
            $house->address = [
                'province' => $request->input('province'),
                'district' => $request->input('district'),
                'sector' => $request->input('sector'),
                'cell' => $request->input('cell'),
                'village' => $request->input('village'),
            ];

            $house->additional_description = $request->input('house_description');
            $userId = Auth::id();
            $user = User::find($userId);
            if (!$user) {
                return with('error', 'User not found');
            }
            \Log::info('User ID:' . $userId);
            \Log::info('User Attributes:' . json_encode($user->getAttributes()));
            $user->houses()->save($house);
            $house->save();
            // Associate the house with the authenticated user
            // $user->houses()->save($house); // This will set the user_id field
            // Display a success message
            return redirect('/dashboard/add-house')->with('success', 'house Added successfully');
        } catch (\Exception $e) {
            // Display the detailed error messages during development
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    function showViewHouses()
    {
        return view('pages.dashboard.view-houses');
    }
    function showHousesBelongsToMe()
    {
        $housesBelongsToMe = House::with('user')->get();
        return view('pages.dashboard.view-houses', compact('housesBelongsToMe'));
    }
    function showAllHouses()
    {
        if (auth()->user()->role === 'admin') {
            $housesAll = House::all();
        } elseif (auth()->user()->role === 'landlord') {
            $housesAll = auth()->user()->houses;
        }

        return view('pages.dashboard.view-houses', compact('housesAll'));

    }
    function deleteHouse($id)
    {
        try {
            $house = House::findOrFail($id);
            $house->delete();
            return redirect()->back()->with('success', 'House deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the house');
        }
    }
    public function updateHouse(Request $request, $id)
    {
        try {
            // Validate the form data
            $request->validate([
                'house_name' => 'required|string',
                'area' => 'required|string',
                'price' => 'required|integer',
                'type' => 'required|string',
                'rooms' => 'required|integer',
                'house_description' => 'nullable|string',
            ]);

            // Find the house by ID
            $house = House::findOrFail($id);

            // Update the house details based on the form input
            $house->update([
                'house_name' => $request->input('house_name'),
                'area' => $request->input('area'),
                'price' => $request->input('price'),
                'type' => $request->input('type'),
                'rooms' => $request->input('rooms'),
                'additional_description' => $request->input('house_description'),
            ]);

            // Handle file upload and store images in the storage disk
            $imageUrls = [];
            if ($request->hasFile('image_urls')) {
                foreach ($request->file('image_urls') as $index => $image) {
                    // Validate each image individually
                    $request->validate([
                        'image_urls.' . $index => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('images', $imageName, 'public'); // Store image in the 'public' disk under the 'images' directory
                    $imageUrls[] = 'storage/images/' . $imageName;
                }
                $house->image_urls = json_encode($imageUrls); // Convert the array to JSON
            }


            $house->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'House updated successfully');
        } catch (\Exception $e) {
            // Handle the exception (e.g., display an error message)
            return response()->json(['error', 'Failed to update the house' . $e->getMessage()]);
        }
    }
    public function toggleHouse(Request $request, $id)
    {
        $house = House::findOrFail($id);
        $house->update([
            'available' => $request->input('available'),
        ]);

        return redirect()->back()->with('success', 'House availability toggled successfully');
    }
    public function showAvailableHouse()
    {
        $availableHouses = House::where('available', true)->paginate(6);
        return view('pages.properties', compact('availableHouses'));
    }
    public function showLatestHouses()
    {
        $latestHouses = House::where('available', true)->latest()->get();
        return view('welcome', compact('latestHouses'));
    }
    public function searchProperties(Request $request)
    { // Validate the incoming request data as needed

        $type = $request->input('type');
        $province = $request->input('province');
        $rooms = $request->input('rooms');
        $maxPrice = $request->input('max_price');

        $query = House::query();

        if ($type !== 'All Type') {
            $query->where('type', $type);
        }

        if ($province !== 'all province') {
            $query->where('address->province', $province);
        }

        if ($rooms > 0) {
            $query->where('rooms', '>=', $rooms);
        }

        if ($maxPrice > 0) {
            $query->where('price', '<=', $maxPrice);
        }

        $properties = $query->paginate(9); // Adjust the pagination as needed

        return view('pages.searched-property', compact('properties'));
    }

}
