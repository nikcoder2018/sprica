<?php 
use App\Helpers\Language;
$lang = new Language;
?>
@extends('layouts.admin.main')

@section('stylesheets')
<link href="{{ asset('css/quill/quill.snow.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link href="{{asset('dist/css/validation_master.css')}}" rel="stylesheet">

<style>
    .dataTables_length, .dataTables_filter, .dataTables_iinfo, .ddataTables_paginate {
        display: none;
    }
    .ql-toolbar.ql-snow{
        border: 0;
        padding: 0px;

    }
    .ql-toolbar.ql-snow .ql-formats{
        padding: 2px;
        border: 1px solid #d6d6d68a;
        border-radius: 3px;
    }

    .editor{
        margin-top: 10px;
        border: 1px solid #d6d6d68a !important;
        border-radius: 3px;
        height: 500px;
    }

    .modal-input-title{
        height: calc(3rem + 2px);
        border-bottom: 1px solid #babfc7;
        border-top: 0px !important;
        border-left: 0px !important;
        border-right: 0px !important;
        border-radius: 0px !important;
        padding: 0;
        font-size:1.5rem;
    }



    .hide{
        display: none;
    }
</style> 
@endsection
@section('content')
<div style="height:51px" class="card card-default color-palette-bo">
    <div style="height:51px" class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-envelope"></i> Email Templates</h3>
        </div>
        <div class="d-inline-block float-right">
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary add_modal"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>


<section class="content">
    <div class="card">
        <div class="card-body p-0">
            <table id="example1" class="table table-striped emailtemplate">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>                                   
                    @foreach($templates as $template)
                    <tr>
                        <td>{{ $template->title }}</td>
                        <td>{{ $template->subject }}</td>
                        <td>
                            <a href="#" class="edit_template" data-id="{{ $template->id }}"><i class="fa fa-fw fa-pencil text-warning"></i></a>
                            <a href="#" class="view_template" data-id="{{ $template->id }}"><i class="fa fa-fw fa-eye text-primary"></i></a>
                            <a href="#" class="delete_template" data-id="{{ $template->id }}"><i class="fa fa-fw fa-trash text-danger "></i></a>
                        </td>
                    </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade add__modal" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form action="{{ route('emailtemplates.store') }}" method="POST"> 
                <div class="modal-header"> 
                    <input type="text" name="title" class="form-control round modal-input-title" value="" required>
                    <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                </div>

                @csrf
                <div class="modal-body bg">
                    <div class="form-body mt-1">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" name="subject" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="form-group">
                                            <label for="message">Message</label>
                                            
                                            <div id="snow-wrapper">
                                                <div id="snow-container">
                                                    <div class="editor">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row skin skin-flat">
                                            <div class="col-md-6 col-sm-12">
                                                <fieldset>
                                                    <input type="checkbox" id="input-1" name="word_template">
                                                    <label for="input-1">Make this as Text Templates</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h3>Add variable</h3>
                                <p><i>
                                    <small>Variables are populated with custom information when applied to an invoice.    </small>
                                </i></p>

                                <p><i>
                                    <small>Place your cursor in the location where you would like to insert the variable, the <strong>click below to insert</strong></small>
                                </i></p>

                                <div class="options">
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-variable="name"> NAME <br> <small>[[ name ]]</small></button>
                                </div>

                                @if(count($text_templates) > 0)
                                <div class="form-group mt-2">
                                    <label>Use word template</label>
                                    <select class="form-control select-word-template">
                                        <option value="">none</option>
                                        @foreach($text_templates as $text)
                                        <option value="{{ $text->id }}" >{{ $text->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="template-preview mt-1 hide">
                        
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary preview-button">Preview</button>
                    <button class="btn btn-outline-success" type="submit"> Save </button>
                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('js/quill/quill.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#example1").DataTable();
    });
    $(document).ready(function () { 
       var toolbarOptions = [
           ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

           [{ 'header': 1 }, { 'header': 2 }],               // custom button values
           [{ 'list': 'ordered'}, { 'list': 'bullet' }, 'blockquote', 'code-block'],

           [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript

           [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

           [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

           [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
           [{ 'font': [] }],

           [{ 'align': [] }],

           ['link', 'image'],

           ['clean']                                         // remove formatting button
       ];

       let quill = new Quill('.editor', {
           modules: {
               toolbar:{
                   container: toolbarOptions,
                   handlers: {
                       image: imageHandler
                   }
               }
           },
               theme: 'snow'
       });
       
       function imageHandler() {
           var range = this.quill.getSelection();
           var value = prompt('What is the image URL');
           if(value){
               this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
           }
       }

       $(document).on('click', '.add_modal', function() {                
           let add_modal = $('.add__modal');
           let form = add_modal.find('form');
           
           $('.form-body').removeClass('hide');
           $('.template-preview').addClass('hide');
           $('.preview-button').text('Preview');
           
           
           add_modal.modal();
           form[0].reset();
           quill.root.innerHTML = "";
           form.find('input[name=id]').remove();
           form.attr('action', "{{ route('emailtemplates.store') }}");
           form.find('input[name=title]').val('New Template');
           form.find('input[name=title]').focus();
       });

       $(document).on('click', '.edit_template', async function() {  
           $('.form-body').removeClass('hide');
           $('.template-preview').addClass('hide');
           $('.preview-button').text('Preview');

           let add_modal = $('.add__modal');
           let form = add_modal.find('form');
           let id = $(this).data().id;
           
           add_modal.modal();
           quill.root.innerHTML = "";
           form[0].reset();
           form.attr('action', "{{ route('emailtemplates.update') }}");
           
           const result = await $.ajax({
               url: "{{ route('emailtemplates.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           const template = result['data'].template;
           form.find('input[name=id]').remove();
           form.prepend(`<input type="hidden" name="id" value="${template.id}" />`);
           form.find('input[name=title]').val(template.title);
           form.find('input[name=subject]').val(template.subject);
           form.find('input[name=sender]').val(template.sender);
           quill.root.innerHTML = template.body;

           switch(template.attach_invoice){
               case 0:
                   form.find('input[name=attach_invoice]').prop('checked', false);
               break;
               case 1:
                   form.find('input[name=attach_invoice]').prop('checked', true);
               break;
           }

           switch(template.embed_invoice){
               case 0:
                   form.find('input[name=embed_invoice]').prop('checked', false);
               break;
               case 1:
                   form.find('input[name=embed_invoice]').prop('checked', true);
               break;
           }

           switch(template.word_template){
               case 0:
                   form.find('input[name=word_template]').prop('checked', false);
               break;
               case 1:
                   form.find('input[name=word_template]').prop('checked', true);
               break;
           }

           form.find('input[name=title]').focus();

           
           $('.template-preview').html('');

       });

       $(document).on('click', '.view_template', async function() {  
           $('.template-preview').html('');
           $('.form-body').addClass('hide');
           $('.template-preview').removeClass('hide');
           $('.preview-button').text('Edit');

           let add_modal = $('.add__modal');
           let form = add_modal.find('form');
           let id = $(this).data().id;
           
           add_modal.modal();
           quill.root.innerHTML = "";
           form[0].reset();
           form.attr('action', "{{ route('emailtemplates.update') }}");
           
           const result = await $.ajax({
               url: "{{ route('emailtemplates.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           const template = result['data'].template;
           form.find('input[name=id]').remove();
           form.prepend(`<input type="hidden" name="id" value="${template.id}" />`);
           form.find('input[name=title]').val(template.title);
           form.find('input[name=subject]').val(template.subject);
           form.find('input[name=sender]').val(template.sender);
           quill.root.innerHTML = template.body;

           switch(template.attach_invoice){
               case 0:
                   form.find('input[name=attach_invoice]').prop('checked', false);
               break;
               case 1:
                   form.find('input[name=attach_invoice]').prop('checked', true);
               break;
           }

           switch(template.embed_invoice){
               case 0:
                   form.find('input[name=embed_invoice]').prop('checked', false);
               break;
               case 1:
                   form.find('input[name=embed_invoice]').prop('checked', true);
               break;
           }

           form.find('input[name=title]').focus();

           

           
           $('.template-preview').html('<div class="ql-snow"><div class="ql-editor">'+quill.root.innerHTML+'</div></div>');
       });

       $(document).on('click', '.delete_template', async function() {
           let id = $(this).data().id;

           Swal.fire({
               text: 'Are you sure you want to delete this template?',
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!",
               confirmButtonClass: "btn btn-primary",
               cancelButtonClass: "btn btn-danger ml-1"
           }).then(async result => {
               if(result.value){
                   const delete_template = await $.ajax({
                       url: "{{ route('emailtemplates.destroy') }}",
                       type: 'POST',
                       data: {
                           _token: "{{ csrf_token() }}",
                           id
                       }
                   });

                   if(delete_template.success){
                       Swal.fire({
                           text: delete_template.msg,
                           type: 'success',
                       }).then(()=>{
                           location.reload();
                       });
                   }
               }
           });
       });

       $('.options').on('click', 'button', function(){
           quill.focus();
           let data = $(this).data();
           let caretPosition = quill.getSelection(true);
           quill.insertText(caretPosition, '[['+data.variable+']]');
       });
       
       $('.add__modal').on('submit', 'form', function(e){
           e.preventDefault();
           let editor_content = quill.root.innerHTML;

           $.ajax({
               url: $(this).attr('action'),
               type: 'POST',
               data: $(this).serialize() + '&body=' + editor_content,
               success: function(resp){
                   if(resp.success){
                       Swal.fire({
                           text: resp.msg,
                           type: 'success'
                       }).then(() => {
                           location.reload();
                       })
                   }
               }
           })
       });

       $('.select-word-template').on('change', async function(){

           const id = $(this).val();

           if(id != null && id != ""){
                   const { data } = await $.ajax({
                   url: "{{ route('emailtemplates.edit' )}}",
                   type: 'POST',
                   data: {
                       _token: "{{ csrf_token() }}",
                       id: id
                   }
               });

               quill.root.innerHTML = data.template.body;

           
           }else{
               quill.root.innerHTML = "";
           }
           
           
           
       });

       $(document).on('click','.preview-button',function(){

           let content = quill.root.innerHTML;

           if($('.form-body').hasClass('hide')){
               $(this).text('Preview');
               $('.form-body').removeClass('hide');
               $('.template-preview').addClass('hide');
           }else{
               $('.form-body').addClass('hide');
               $('.template-preview').removeClass('hide');
               $('.template-preview').html('<div class="ql-snow"><div class="ql-editor">'+content+'</div></div>');
               $(this).text('Back');
           }
       });

    });

   
</script>
@endsection