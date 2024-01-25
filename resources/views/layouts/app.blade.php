<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sahoj Pora</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Include Tailwind CSS stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
    body {
    font-family: 'Inter UI', sans-serif;
    background: #fff;
}

header {
    position: fixed;
    width: 100%;
    background-color: white;
    z-index: 1000;
    margin-bottom:1rem;
}

aside {
    position: fixed;
    height: 100%;
    width: 260px;
    z-index: 100;
    overflow-y: auto;
    margin-top: 64px;
    
}
 .iconColor{
    color:#A1A1AA;
 }
 .textColor{
    color:#3F3F46;
    font-size:14px;
 }
 .active {
    font-size:14px;
 }
main {
    margin-left: 260px; /* Width of the sidebar */
    flex: 1;
    padding: 1rem;
    padding-top: 64px; /* Height of the fixed header */
    overflow-y: auto;
    z-index: 1; /* Add this line to make the content appear above the sidebar */
}


    </style>
</head>

<body>

    <!-- Top Navbar -->
    <header class="bg-white border-b p-4">
        <div class="flex justify-between items-center">
            <!-- Your App Title or Logo -->
            <div class="text-xl font-bold">LMS Admin</div>
            <!-- User Profile or Logout Button -->
            <div>
                <!-- Add your user profile or logout button here -->
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex space-y-8 font-inter">

        <!-- Side Navbar -->
        <aside class=" text-gray-700">
            <!-- Sidebar Links -->
            <nav class="space-y-3 mt-7">
                <a href="/admin" class="flex gap-2 px-3 py-2  rounded-md mx-3 hover:bg-gray-100 textColor">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 iconColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
    
                Dashboard</a>
                <a href="/admin/books" class="flex gap-2 px-3 py-1 my-2 rounded-md mx-3 hover:bg-gray-100 textColor">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 iconColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
    
                Books</a>
                <a href="/admin/categories" class="flex gap-2 px-3 py-1 my-2 rounded-md mx-3  hover:bg-gray-100 textColor">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 iconColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                </svg>
    
                Categories</a>              
                <a href="/admin/courses" class="flex gap-2 px-3 py-1 my-2 rounded-md mx-3 hover:bg-gray-100 textColor"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 iconColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                Courses</a>
                <a href="/admin/users" class="flex gap-2 px-3 py-1 my-2 rounded-md mx-3 hover:bg-gray-100 textColor ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 iconColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
    
                Users</a>
                <a href="{{ route('user-messages') }}" class="flex gap-2 px-3 py-1 my-2 rounded-md mx-3   {{ request()->routeIs('user-messages', 'user-chats') ? 'text-yellow-500 active bg-gray-100' : 'textColor' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  {{ request()->routeIs('user-messages', 'user-chats') ? 'text-yellow-500' : 'iconColor' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                </svg>
    
                Chat Messages</a>
            </nav>
        </aside>

        <!-- Page Content -->
        <main class="flex-1">
            <!-- Your page content goes here -->
            @yield('content')
        </main>
    </div>

    <!-- Include your scripts -->

</body>

</html>
