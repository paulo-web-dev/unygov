<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use App\Models\Photo;
class ApiController extends Controller
{
    public function CadastroGaleria(Request $request){
    
        $galery = new Galery();
    
        if (isset($request->link)) {        
            $galery->capa = $request->link;
            $galery->Tipo = 'Link';
        } else {
            if ($request->hasFile('fileCapa')) {
                $image = $request->file('fileCapa');
                $name = $image->getClientOriginalName();
                $galery->capa = $name;
                
                $destinationPath = public_path('/storage/galeria/capas');
                $image->move($destinationPath, $name);
            } else {
                return back()->with('error', 'File not uploaded.');
            }
        }
    
        $galery->id_class = $request->curso;
        $galery->status = $request->status;
        $galery->id_antigo = 0;        
        $galery->save(); 
    
        if ($request->hasFile('fileAlbum')) {
            $files = $request->file('fileAlbum');
            $i = 0;
            foreach ($files as $file) {
                $photos = new Photo();
    
                if (isset($request->link)) {        
                    $name = $request->link; 
                    $photos->Tipo = 'Link';
                } else {
                    $name = $file->getClientOriginalName();
                }
    
                $photos->id_galeria = $galery->id;
                $photos->foto = $name;
                
                $destinationPath = public_path('/storage/galeria/fotos'); 
                $file->move($destinationPath, $name);
    
                $photos->save();
                $i++;
            }
        }
       
        return redirect()->to('https://unyflex.com.br/painel/galerias');
    }
}