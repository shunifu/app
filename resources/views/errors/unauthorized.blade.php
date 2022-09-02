<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <div class="row justify-content-center align-self-center">
        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_GFJoe1.json" background="transparent"
            speed="1"
            style="width: 500px; height: 500px; margin-left:auto; margin-right:auto; margin-top:auto; margin-bottom:auto"
            loop autoplay></lottie-player>


    </div>
    <div class="row justify-content-center align-self-center">
        <span class="lead display-3 text-muted">Error</span>

    </div>
    <div class="row justify-content-center align-self-center">

        <span class="display-5 text-muted"> Access restricted</span>
    </div>


</x-app-layout>