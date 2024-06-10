<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Article;

class Articles extends Component
{

    public $articles, $title, $contents, $article_id;
    public $isModalOpen = 0;
    public function render()
    {
        $this->articles = Article::all();
        return view('livewire.articles');
    }
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    private function resetCreateForm(){
        $this->title = '';
        $this->contents = '';
    }
    
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'contents' => 'required',
        ]);
    
        Article::updateOrCreate(['id' => $this->article_id], [
            'title' => $this->title,
            'contents' => $this->contents,
        ]);
        session()->flash('message', $this->article_id ? 'Article updated.' : 'Article created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->article_id = $id;
        $this->title = $article->title;
        $this->contents = $article->contents;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Article::find($id)->delete();
        session()->flash('message', 'Article deleted.');
    }
}