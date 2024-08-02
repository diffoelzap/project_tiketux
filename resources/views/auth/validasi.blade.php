@extends('layout.main-layout')
@section('body')
<section class="bg-white dark:bg-gray-900">

<center>
   <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Upload Validasi Email</h2>

    <form class="flex items-center max-w-lg mx-auto" action="{{ route('postCheckEmail') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="flex items-center w-full">
            <input class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="default_size" type="file" name='file'>
            <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-2">
                Import
            </button>
        </div>
    </form>
    
    <br>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-75">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="example">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Transaction
                </th>
                <th scope="col" class="px-6 py-3">
                    Name File
                </th>
                <th scope="col" class="px-6 py-3">
                    Count Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody id="transaksiBody" class="bg-white dark:bg-gray-900">
           
            
        </tbody>
    </table>

    <div id="pagination" class="px-6 py-4">
    </div>

</div>

    
</center>









    
</section>
@endsection