<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use App\Models\Photo;
use App\Models\Material;
use App\Models\MaterialPanels;
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

    public function AddFotos(Request $request){
    
    
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $i = 0;
            foreach ($files as $file) {
                $photos = new Photo();
    
                if (isset($request->link)) {        
                    $name = $request->link; 
                    $photos->Tipo = 'Link';
                } else {
                    $name = $file->getClientOriginalName();
                }
    
                $photos->id_galeria = $request->galeria;
                $photos->foto = $name;
                
                $destinationPath = public_path('/storage/galeria/fotos'); 
                $file->move($destinationPath, $name);
    
                $photos->save();
                $i++;
            }
        }
       
        return redirect()->to('https://unyflex.com.br/painel/galerias');
    }

    public function CadastroMaterial (Request $request){
      
      
         
      
                
                // dd($request->file('file'));
                $file = $request->file('file');
                $material = new Material(); 
                $originalName = $file->getClientOriginalName(); 
                        
                $novonome = $originalName; // Use o nome original do arquivo
    
                $confere = Material::where('file_name', $novonome)->first();
             
               
                // Salvar informações no banco de dados
                $material->name = $request->nome;
                $material->file_name = $novonome;
                $material->type = $request->tipo;
                $material->status = $request->status;
                $material->id_antiga = 9417;
                $id_cursos = $request->id_cursos;
                $id_presencial = $request->id_presencial;
                $painelnovo = 'painelnovo';
                $hoje = date('Y-m-d');
                $usuario = 'NOVA API';
    
              
                $material->save();
                 
  
                    $materialPanel = new MaterialPanels();
                    $materialPanel->material_id = $material->id;
                    $materialPanel->course_id = $request->id_presencial;
                    $materialPanel->save();
    
                   
    
                    $destinationPath = public_path('/storage/materials');
                    $file->move($destinationPath, $novonome);
           
       
            return redirect()->to('https://unyflex.com.br/painel/materiais');
     
    }


    public function UpdMaterial (Material $material, Request $request){
      


        if ($request->arquivo == null){
            $material->name = $request->nome;
            $material->type = $request->tipo;
            if(isset($request->link)){
                $material->file_name = $request->link;
            }
            $material->status = $request->status;
            if ($material->save()) {
                return redirect()->to('https://unyflex.com.br/painel/materiais');

            } else {
                return redirect()->to('https://unyflex.com.br/painel/materiais');

            }

        }

        $material->name = $request->nome;
        $name=$request->arquivo->getClientOriginalName();
        $material->file_name = $request->arquivo->getClientOriginalName();
        $material->type = $request->tipo;
        $material->id_antiga = 9417;
        $material->status = $request->status;
        if ($material->save()) {           
            $image = $request->file('arquivo');
            $destinationPath = public_path('/storage/materials');
            $image->move($destinationPath, $name);
            return redirect()->to('https://unyflex.com.br/painel/materiais');

        } else {
            return redirect()->to('https://unyflex.com.br/painel/materiais');
        }  
   
}
}