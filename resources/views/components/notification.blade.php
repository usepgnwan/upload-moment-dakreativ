@if(session()->has('notify'))
    @php
    $notify = session()->get('notify');
    @endphp
@endif

<div
    x-data="{
        messages: [],
        type: '',
        messageType: '',
        addMessage(message ) {
            this.messageType = message.type ?? 'success';
            this.messages.push(message.message ?? '');
            let $type = message.type ?? 'success';
            if($type == 'success'){
                this.type = 'bg-green-600 text-white';
            }else if($type == 'error'){
                this.type = 'bg-red-600 text-white';
            }else{
                this.type = 'bg-yellow-300 text-white';
            }
            setTimeout(() => { this.removeMessage(message) }, 3000);
        },
        removeMessage(message) {
            this.messages.splice(this.messages.indexOf(message), 1);
        },
        init() {
            // Check if there's a session message and push it to the messages array
            @if(isset($notify))
                this.addMessage({message: '{{ $notify['message'] }}', type: '{{ $notify['type'] ?? 'success' }}' });
            @endif
        }
    }"
    @notify.window="addMessage($event.detail[0]  ?? { message: '{{ $notify['message'] ?? '' }}', type: '{{ $notify['type'] ?? 'success' }}' })"
 class="fixed top-0 right-0 z-50 px-4 py-6 pointer-events-none"
>

    <template x-for="(message, messageIndex) in messages" :key="messageIndex" hidden >

        <div
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            :class="type"
            class="max-w-sm w-full min-w-96  shadow-lg rounded-lg pointer-events-auto mt-3 "
        >
            <div class="rounded-lg shadow-xs overflow-hidden  ">
                <div class="p-4">
                    <div class="flex items-start w-full">
                        <div class="flex-shrink-0">
                            <!-- Success Icon -->
                            <svg x-show="messageType === 'success'"class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>

                            <!-- Error Icon -->
                            <svg x-show="messageType === 'error'" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>

                            <!-- Warning Icon -->
                            <svg x-show="messageType === 'warning'" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="message" class="text-sm leading-5 font-medium "></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="removeMessage(message)" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
