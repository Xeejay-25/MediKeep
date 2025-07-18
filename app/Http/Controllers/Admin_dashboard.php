<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Admin_dashboard extends Controller
{
    public function home()
    {
        $totalUsers = User::count();

        $totalProducts = Product::count();
        $lowStockThreshold = 5; 
        $lowStock = Product::where('quantity', '>', 0)
                            ->where('quantity', '<=', $lowStockThreshold)
                            ->count();
        $outOfStock = Product::where('quantity', '=', 0)->count();
        $totalSuppliers = Supplier::count();
        $lowStockProducts = Product::where('quantity', '>', 0)
            ->where('quantity', '<=', $lowStockThreshold)
            ->get();
        $outOfStockProducts = Product::where('quantity', '=', 0)->get();

        $suppliers = Supplier::all();

        $salesData = DB::table('order')
        ->select(
            DB::raw("strftime('%m', order_date) as month"),
            DB::raw("COUNT(*) as total_orders"),
            DB::raw("SUM(total_amount) as total_sales")
        )
        ->groupBy(DB::raw("strftime('%m', order_date)"))
        ->get();

        // Format the sales data into usable arrays
        $formattedData = [
            'months' => $salesData->pluck('month')->map(function ($month) {
                return date('F', mktime(0, 0, 0, $month, 10)); // Convert month number to month name
            }),
            'total_orders' => $salesData->pluck('total_orders'),
            'total_sales' => $salesData->pluck('total_sales'),
        ];


        return view('admin.home', compact(
            'totalUsers',
            'totalProducts',
            'lowStock',
            'outOfStock',
            'totalSuppliers',
            'suppliers',
            'lowStockProducts',
            'outOfStockProducts',
            'formattedData'));
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        $archivedUsers = User::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        return view('admin.users.index', compact('users', 'archivedUsers'));
    }

    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'role' => 'required|integer|in:1,2,3',
            'status' => 'required|string|in:pending,approved,rejected,disabled',
            'email_verified' => 'required|boolean',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);
    
        if ($request->email_verified == 1) {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:4|confirmed',
            'role' => 'required|integer|in:1,2,3',
            'status' => 'required|string|in:pending,approved,rejected,disabled',
            'email_verified' => 'required|boolean',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->status = $request->status;
    
        if ($request->email_verified == 1) {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User archived successfully.');
    }
        
    public function destroyForever($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
    
        return redirect()->route('users.index')->with('success', 'User permanently deleted.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        $user->status = 'pending';
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User restored and moved to pending status successfully.');
    }
}
