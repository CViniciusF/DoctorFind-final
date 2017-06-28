<?php

use Illuminate\Database\Seeder;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //delete users table records
         DB::table('especialidades')->delete();
         //insert some dummy records
         DB::table('especialidades')->insert(
           array(
             array('nome_especialidade'=>'Acupuntura', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Alergia e Imunologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Anestesiologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cardiologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia Cardiovascular', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia da Mão', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia da Cabeça e Pescoço', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia do Aparelho Digestivo', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia Geral', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia Pediátrica', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia Plástica', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia Torácica', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Cirurgia Vascular', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Clinica Médica', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Coloproctologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Dermatologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Endocrinologia e MEtabologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Endoscopia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Gastroenterologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Geriatria', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Ginecologia e Obstetricia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Hematologia e Hemoterapia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Homeopatia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Infectologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Mastologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina de Familia e Comunidade', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina de Tráfego', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina do Trabalho', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina Esportiva', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina Fisica e Reabilitação', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina Intensiva', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina Legal e Pericia Médica', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina Nuclear', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Medicina Preventiva e Social', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Nefrologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Neurocirurgia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Neurologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Nutrologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Oftalmologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Oncologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Ortopedia e Traumatologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Otorrinolaringologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Patologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Pediatria', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Pneumologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Psicanálise', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Psiquiatria', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Radiologia e Diagnóstico por imagem', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Radioterapia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Reumatologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Urologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
             array('nome_especialidade'=>'Odontologia', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")),
        ));
    }
}
