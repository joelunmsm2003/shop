<?php
class Contador extends Eloquent
{
    //un curso puede pertenecer a muchos usuarios, muchos a muchos con users
    public function users()
    {
        return $this->belongsTo("User");
    }    
}