<x-layout1>   
    <x-slot:title>{{$title}}</x-slot:title> 
    <!-- x slot calls title -->
    <h2 class="text-xl text-gray-800 mb-4">Hello, my name is <?=$name?></h2>
    <h3 class="text-lg text-gray-700">You can contact me at 
        <a href="mailto:christopher02@student.ciputra.ac.id" class="text-indigo-600 hover:text-indigo-800">christopher02@student.ciputra.ac.id</a>
    </h3>
</x-layout1>

