<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Project;


class CustomerProjectController extends Controller
{
    public function listProjectsForCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer->projects);
    }

    public function addProjectToCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $projectId = $request->input('project_id');
        $customer->projects()->attach($projectId);

        return response()->json(['message' => 'Project added to customer successfully']);
    }

    public function removeProjectFromCustomer($id, $projectId)
    {
        $customer = Customer::findOrFail($id);
        $customer->projects()->detach($projectId);

        return response()->json(['message' => 'Project removed from customer successfully']);
    }

    public function listCustomersForProject($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project->customers);
    }

    public function addCustomerToProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $customerId = $request->input('customer_id');
        $project->customers()->attach($customerId);

        return response()->json(['message' => 'Customer added to project successfully']);
    }

    public function removeCustomerFromProject($id, $customerId)
    {
        $project = Project::findOrFail($id);
        $project->customers()->detach($customerId);

        return response()->json(['message' => 'Customer removed from project successfully']);
    }
}
