<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $title="";
    public $tasks;


    protected $rules = [
        'title' => 'required|min:3|max:255|string',
    ];

    public function mount()
    {
        $this->tasks = Task::all();
    }
    public function addTask()
    {
        $this->validate();
        Task::create(['title' => $this->title, 'completed' => false]);
        $this->title = '';
        $this->tasks = Task::all();

        Session()->flash('message', 'Task added successfully.');
    }

    public function deleteTask($id)
    {
        Task::findOrFail($id)->delete();
        $this->tasks = Task::all();

        Session()->flash('message', 'Task deleted successfully.');
    }



    public function render()
    {
        return view('livewire.task-manager');
    }
}
