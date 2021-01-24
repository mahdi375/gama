<?php

class Games
{
    public function __construct()
    {

    }
    public function index()
    {
        echo 'Index (show list of all games)';
    }
    public function show()
    {
        echo 'Show one Game';
    }
    public function store()
    {
        echo 'Store a game';
    }
    public function update()
    {
        echo 'Update a game';
    }
    public function destroy()
    {
        echo 'Destroy a game';
    }
}

?>