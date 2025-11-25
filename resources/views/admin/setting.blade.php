@extends('admin.layout.layout')

@section('title', 'Settings')

@section('page-title', 'Settings')

@section('content')
<div class="container-fluid">	
    <div class="card card-dark">                    
      <!-- form start -->
      <form action="{{route('admin.submit.category')}}" method="post" id="settingForm" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">                            
                    <div class="form-group">                        
                        <label for="site_title">Site Title</label>
                        <input type="text" class="form-control" name="site_title" id="site_title" value="{{$setting[0]->value}}">
                    </div>                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$setting[3]->value}}">
                    </div>
                    <div class="form-group">
                        <label for="number">Mobile Number</label>
                        <input type="tel" class="form-control" name="number" id="number" value="{{$setting[4]->value}}">
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp Number</label>
                        <input type="tel" class="form-control" name="whatsapp" id="whatsapp" value="{{$setting[5]->value}}">
                    </div>
                        
                    <div class="form-group">
                        <label>Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$setting[11]->value}}">
                    </div>
                    <div class="form-group">
                        <label>Meta Keyword (comma seprated)</label>
                        <textarea class="form-control" rows="2" name="meta_keywords" id="meta_keywords" placeholder="Meta Keyword">{{$setting[12]->value}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" rows="2" name="meta_description" id="meta_description" placeholder="Meta Description">{{$setting[13]->value}}</textarea>
                    </div>         
                    
                </div>
                <div class="col-md-6">  
                    
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{$setting[6]->value}}">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{$setting[7]->value}}">
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{$setting[8]->value}}">
                    </div>
                    <div class="form-group">
                        <label for="linked_in">LinkedIn</label>
                        <input type="text" class="form-control" name="linked_in" id="linked_in" value="{{$setting[9]->value}}">
                    </div>
                    <div class="form-group">
                        <label for="youtube">Youtube</label>
                        <input type="text" class="form-control" name="youtube" id="youtube" value="{{$setting[10]->value}}">
                    </div>
                    <div class="form-group">
                        <label for="page_record">Page Record</label>
                        <input type="number" class="form-control" name="page_record" id="page_record" value="{{$setting[14]->value}}">
                    </div>
                    <div class="form-group mt-4">                    
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="site_logo" name="site_logo"> 
                        <label class="custom-file-label" for="site_logo">Site Logo</label>
                      </div>
                      <img src="{{ asset('image/logo/' . getSetting('logo')) }}" alt="{{getSetting('logo')}}" width="80" class="img-thumbnail">
                    </div>  
                    <div class="form-group mt-3">                    
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="favicon" name="favicon"> 
                        <label class="custom-file-label" for="favicon">Site Favicon</label>
                      </div>
                      <img src="{{ asset('image/logo/' . getSetting('favicon')) }}" alt="{{getSetting('favicon')}}" width="80" class="img-thumbnail">
                    </div>

                </div>                                
            </div>    
            <button type="submit" class="btn btn-dark btn-block">Submit</button>                                 
        </div>                        
      </form>
    </div>        
</div>
@endsection


@push('scripts_link')
<!-- just validate -->
<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
@endpush


@push('bottom_scripts')
<script>

$(document).ready(function(){   

    const settingValidator = new JustValidate('#settingForm', {
         errorFieldCssClass: 'is-invalid', // class added to invalid fields
         successFieldCssClass: 'is-valid', // class added to valid fields
    });
    settingValidator.addField('#site_title', [
      {rule: 'required', errorMessage:'Site title is required'},
      {rule: 'minLength', value: 3}

    ]).addField('#email', [
       {rule: 'required', errorMessage: 'Email Address is required'},       

    ]).addField('#number', [
       {rule: 'required', errorMessage: 'Mobile number is required'},
       {rule: 'maxLength', value: 10}

    ]).addField('#whatsapp', [
       {rule: 'required', errorMessage: 'Whatsapp number is required'},
       {rule: 'maxLength', value: 10}

    ]).addField('#meta_title', [
       {rule: 'required', errorMessage: 'Meta title is required'},       

    ]).addField('#meta_keywords', [
       {rule: 'required', errorMessage: 'Meta keyword is required'},       

    ]).addField('#meta_description', [
       {rule: 'required', errorMessage: 'Meta description is required'},       

    ]).addField('#page_record', [
       {rule: 'required', errorMessage: 'Per page record is required'},       

    ]).onSuccess((event) => {              
       let form  = event.target;
       let formData = new FormData(form);       

       $.ajax({
           url: '{{route("admin.submit.settings")}}',
           method: 'post',
           dataType: 'JSON',
           data: formData,
           contentType: false,
           processData: false,
           beforeSend: function(){
              showBtnProcess('#settingForm button');
           },
           success: function(response){    
              console.log(response);                
              hideBtnProcess('#settingForm button');                
              if(response.status){                 
                 event.target.reset();
                 settingValidator.refresh();
                 Toast.fire({
                   icon: 'success',
                   title: response.msg
                 });
                 setTimeout(function(){
                   window.location.reload();
                 }, 3000);
              }else{                 
                 Toast.fire({
                   icon: 'error',
                   title: response.msg
                 });
              }
           },
           error: function(error){
              console.log(error);
              hideBtnProcess('#settingForm button');
              Toast.fire({
                 icon: 'error',
                 title: 'Technical Error! Contact to developers'
              });
           }   
       });

    });

});

</script>
@endpush