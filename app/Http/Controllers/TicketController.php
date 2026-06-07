<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Show all tickets
    public function index()
    {
        return view('tickets.index');
    }

    // Show create form
    public function create()
    {
        return view('tickets.create');
    }

    // Store new ticket
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // এখানে database insert হবে (later model use করলে)
        // Ticket::create($request->all());

        return redirect()->back()->with('success', 'Ticket created successfully!');
    }

    // Show single ticket
    public function show($id)
    {
        return view('tickets.show', compact('id'));
    }

    // Edit form
    public function edit($id)
    {
        return view('tickets.edit', compact('id'));
    }

    // Update ticket
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        return redirect()->back()->with('success', 'Ticket updated successfully!');
    }

    // Delete ticket
    public function destroy($id)
    {
        return redirect()->back()->with('success', 'Ticket deleted successfully!');
    }
}