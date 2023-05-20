<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\ParentAttachment;
use App\Models\Religion;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class MYParent extends Component
{

    use WithFileUploads;  // use when upload file on livewire

    // messages for success and error
    public $successMessage,$catchError;

    public $updateMode = false,$Parent_id; // use when edit data

    public $show_table =true; // to hide and show table

    public $currentStep = 1, //  to move others steps

        // Father_INPUTS
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id,


            $photos;

    // validations
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[

            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }

    //function to hide parents table and show add parents
    public function showformadd()
    {
        $this->show_table = false;
    }
    public function backformadd()
    {
        $this->show_table = true;
    }


    public function render()
    {
        return view('livewire.m-y-parent',[
            'Nationalities' => Nationalitie::all(),
            'Type_Bloods'  => Blood::all(),
            'Religions'   =>Religion::all(),
            //parent Table
            'my_parents'   =>My_Parent::all(),
        ]);
    }
    //first steps father info and validation
    public function firstStepSubmit(){


        $this->validate([
            'Email' => 'required|unique:my__parents,Email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);



         $this->currentStep = 2;

    }

    //second step mother validations
    public function secondStepSubmit(){

            $this->validate([
                'Name_Mother' => 'required',
                'Name_Mother_en' => 'required',
                'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
                'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
                'Phone_Mother' => 'required',
                'Job_Mother' => 'required',
                'Job_Mother_en' => 'required',
                'Nationality_Mother_id' => 'required',
                'Blood_Type_Mother_id' => 'required',
                'Religion_Mother_id' => 'required',
                'Address_Mother' => 'required',
            ]);


        $this->currentStep = 3;
    }
        // save info to database
    public function submitForm()
    {
        try {

            $My_Parent = new My_Parent();

            //father info  we use $this not $request [ livewire ]
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
            $My_Parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
            $My_Parent->Religion_Father_id = $this->Religion_Father_id;
            $My_Parent->Address_Father = $this->Address_Father;

            // Mother info
            $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $My_Parent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->Religion_Mother_id = $this->Religion_Mother_id;
            $My_Parent->Address_Mother = $this->Address_Mother;

            //save to database
            $My_Parent->save();

            //attachments

            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storePubliclyAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                   $dd = ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => My_Parent::latest()->first()->id
                    ]);
                }

            }




            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;


        }catch (\Exception $e) {
            $this->catchError = $e->getMessage();
               // $this->catchError = trans('messages.error'); //$e->getMessage();
        };
    }

    //back
    public function back($sep){

        return $this->currentStep = $sep;

    }

        ####################################################
        ####################################################
        ############# Edit Form Parents ####################
        ####################################################
        ####################################################

    public function edit($id){

        $this->updateMode = true;
        $this->show_table = false;
        $My_Parent = My_Parent::where('id',$id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en');
        $this->National_ID_Father =$My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $My_Parent->Blood_Type_Father_id;
        $this->Address_Father =$My_Parent->Address_Father;
        $this->Religion_Father_id =$My_Parent->Religion_Father_id;

        $this->Name_Mother = $My_Parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('Job_Mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('Job_Mother', 'en');
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->Blood_Type_Mother_id;
        $this->Address_Mother =$My_Parent->Address_Mother;
        $this->Religion_Mother_id =$My_Parent->Religion_Mother_id;

    }

        public function firstStepedit(){

            $this->updateMode = true;
            $this->currentStep = 2;
        }
        public function secondStepedit(){
            $this->updateMode = true;
            $this->currentStep = 3;
        }

        // submit edit
    public function submitForm_edit(){

        $id = $this->Parent_id;
        $myparents = My_Parent::find($id);
        $myparents->update([
           // ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            'Email' => $this->Email,
            'Password' => $this->Password,
            'Name_Father' =>  ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
            'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
            'National_ID_Father' =>   $this->National_ID_Father,
            'Passport_ID_Father' =>  $this->Passport_ID_Father,
            'Phone_Father' =>  $this->Phone_Father,
            'Nationality_Father_id' => $this->Nationality_Father_id,
            'Blood_Type_Father_id' =>$this->Blood_Type_Father_id,
            'Religion_Father_id' => $this->Religion_Father_id,
            'Address_Father' =>$this->Address_Father,

            'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
            'National_ID_Mother' =>$this->National_ID_Mother,
            'Passport_ID_Mother' => $this->Passport_ID_Mother ,
            'Phone_Mother' => $this->Phone_Mother,
            'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
            'Nationality_Mother_id' => $this->Nationality_Mother_id,
            'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
            'Religion_Mother_id' => $this->Religion_Mother_id,
            'Address_Mother' => $this->Address_Mother,


        ]);
       $message =  $this->successMessage = trans('messages.success');
        return redirect()->to('parents')->with($message);
    }

           ######### End EDit #######################

            ###################################################
            ###################################################
            ############### Delete ############################
            ###################################################
            ###################################################

            public function delete($id){

                $myparents= My_Parent::find($id);

                if(!$myparents){
                    return abort('404');
                }

                //delete attachments
                $myparents->attachments()->delete();
                //deleet parants
                $myparents->delete();

                return redirect()->to('parents');
            }


            ##############################################
            ##############################################
            #################End delete#################
            ##############################################
            ##############################################

    //function to empty form after save to database

    public function clearForm(){

        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';


    }


}
