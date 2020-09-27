<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Ivan',
            'email' => 'ivanlgomes@yahoo.com.br',
            'password' => bcrypt('12345678'),
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Maria',
            'email' => 'mclgomes@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('profiles')->insert([
            'user_id' => '1',
            'full_name' => 'ivanlgomes@yahoo.com.br',
            'institution' => 'Example Institution',
            'bio' => 'User\'s bio goes here',
            'website' => 'https://www.userswebsite.com',
            'profile_picture' => 'userpic.jpg',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('experiments')->insert([
            'id' => 1,
            'user_id_owner' => 1,
            'experiment_name' => 'Demo Experiment Ivan',
            'is_public' => '0',
            'is_active' => '1',
            'welcome_text' => 'Welcome text goes here',
            'consent_text' => 'Consent text goes here',
            'consent_label' => 'Consent label',
            'instructions_text' => 'Instructions text goes here',
            'ending_text' => 'Ending text goes here',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('experiments')->insert([
            'id' => 2,
            'user_id_owner' => 2,
            'experiment_name' => 'Demo Experiment Maria',
            'is_public' => '1',
            'is_active' => '1',
            'welcome_text' => 'Welcome text goes here',
            'consent_text' => 'Consent text goes here',
            'consent_label' => 'Consent label',
            'instructions_text' => 'Instructions text goes here',
            'ending_text' => 'Ending text goes here',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('field_types')->insert([
            'id' => 1,
            'field_type_name' => 'text',
            'field_type_description' => 'Text field, like name, e-mail, place of birth, etc.',
            'has_options' => '0',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('field_types')->insert([
            'id' => 2,
            'field_type_name' => 'number',
            'field_type_description' => 'Number field, like age, number of year living abroad, etc.',
            'has_options' => '0',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('field_types')->insert([
            'id' => 3,
            'field_type_name' => 'select',
            'field_type_description' => 'Select box with options.',
            'has_options' => '1',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('field_types')->insert([
            'id' => 4,
            'field_type_name' => 'radio_buttons',
            'field_type_description' => 'Radio buttons with options and one possible answer.',
            'has_options' => '1',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('personal_data_forms')->insert([
            'id' => 1,
            'owner_id' => 1,
            'description' => 'Personal data form description',
            'created_at' => date("Y-m-d H:i:s") 
        ]);


        DB::table('personal_data_forms_fields')->insert([
            'id' => 1,
            'label' => 'Name',
            'placeholder' => 'Type your name',
            'field_type_id' => 1,
            'is_global' => '1',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('personal_data_forms_fields')->insert([
            'id' => 2,
            'label' => 'Country of Birth',
            'field_type_id' => 1,
            'is_global' => '1',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('personal_data_forms_fields')->insert([
            'id' => 3,
            'label' => 'Age',
            'field_type_id' => 2,
            'is_global' => '1',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('personal_data_forms_fields')->insert([
            'id' => 4,
            'label' => 'Education Level',
            'placeholder' => 'Select one',
            'field_type_id' => 3,
            'options' => '["High School", "Graduation", "Masters Degree", "PHD"]',
            'is_global' => '0',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('fields_in_personal_data_forms')->insert([
            'field_id' => 1,
            'form_id' => 1,
            'is_required' => '1',
            'order' => 0,
            'start_new_page' => '0',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('fields_in_personal_data_forms')->insert([
            'field_id' => 2,
            'form_id' => 1,
            'is_required' => '1',
            'order' => 0,
            'start_new_page' => '0',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('fields_in_personal_data_forms')->insert([
            'field_id' => 3,
            'form_id' => 1,
            'is_required' => '1',
            'order' => 0,
            'start_new_page' => '1',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('fields_in_personal_data_forms')->insert([
            'field_id' => 4,
            'form_id' => 1,
            'is_required' => '0',
            'order' => 0,
            'start_new_page' => '0',
            'created_at' => date("Y-m-d H:i:s") 
        ]);
        
        DB::table('personal_data_form_in_experiment')->insert([
            'experiment_id' => 1,
            'personal_data_form_id' => 1,
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('stimuli_types')->insert([
            'id' => 1,
            'stimuli_type_name' => 'S-01',
            'stimuli_type_description' => 'Sentence shown on screen with answers',
            'text_is_required' => 1,
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('stimuli')->insert([
            'id' => 1,
            'stimuli_type_id' => 1,
            'user_id_owner' => 1,
            'stimuli_text' => 'The leaves wilted',
            'item' => 'Dist',
            'item_id' => 'Exp',
            'condition' => 'PB_lex-lex',
            'condition_code' => 'PB_lex-lex-1',
            'trial' => 1,
            'created_at' => date("Y-m-d H:i:s") 
        ]);
        
        DB::table('answer_fields')->insert([
            'id' => 1,
            'label' => 'Choose one: ',
            'placeholder' => '',
            'field_type_id' => 4,
            'options' => '["1", "2", "3", "4", "5", "6", "7"]',
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('answer_fields_in_stimuli')->insert([
            'answer_field_id' => 1,
            'stimuli_id' => 1,
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('stimuli_lists')->insert([
            'id' => 1,
            'user_id_owner' => 1,
            'list_name' => 'DEMO_Lista1',
            'list_description' => 'List description goes here',
            'is_public' => '0',
            'stimuli_per_page' => 1,
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('stimuli_in_lists')->insert([
            'list_id' => 1,
            'stimuli_id' => 1,
            'order' => 0,
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        DB::table('list_in_experiments')->insert([
            'stimuli_list_id' => 1,
            'experiment_id' => 1,
            'created_at' => date("Y-m-d H:i:s") 
        ]);


    }
}
