<div x-data="{ 
        isOpen: false, 
        closeAlert() { 
            this.isOpen = false; 
        } 
     }" 
     x-init="
        setTimeout(() => isOpen = true, 500);
     "
     x-show="isOpen" style="display: none;"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 backdrop-blur-none"
     x-transition:enter-end="opacity-100 backdrop-blur-sm"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 backdrop-blur-sm"
     x-transition:leave-end="opacity-0 backdrop-blur-none">
    
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-[#0d0d1f]/80" @click="closeAlert()"></div>

    {{-- Modal Content --}}
    <div class="relative w-full max-w-lg bg-[#181836] border border-red-500/30 rounded-2xl shadow-[0_0_40px_rgba(239,68,68,0.2)] overflow-hidden"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95">
         
         {{-- Glowing Header Banner --}}
         <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-red-600 via-yellow-500 to-red-600"></div>

         <div class="p-6 sm:p-8">
             <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-500/10 rounded-full border border-red-500/20 mb-6 relative">
                 <span class="absolute inset-0 rounded-full border-2 border-red-500/50 animate-ping opacity-50"></span>
                 <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                 </svg>
             </div>

             <h2 class="text-2xl sm:text-3xl font-black text-white text-center mb-2 uppercase tracking-tight">
                 {{ __('messages.fraud_title') }}
             </h2>
             <p class="text-red-400 font-bold text-center text-sm sm:text-base uppercase tracking-widest mb-6">
                 {{ __('messages.fraud_subtitle') }}
             </p>

             <div class="space-y-4 text-sm sm:text-base text-slate-300 leading-relaxed bg-white/5 p-5 rounded-xl border border-white/10">
                 <p>
                     {{ __('messages.fraud_desc_1') }}
                 </p>
                 <p>
                     {{ __('messages.fraud_desc_2') }}
                 </p>
                 <p class="text-white font-medium">
                     {{ __('messages.fraud_desc_3') }} <strong class="text-red-400">{{ __('messages.fraud_warning') }}</strong>.
                 </p>
             </div>

             <div class="mt-8 text-center">
                 <button @click="closeAlert()" type="button" class="px-8 py-3 bg-red-600 hover:bg-red-500 text-white font-bold rounded-full transition-all shadow-[0_0_15px_rgba(239,68,68,0.4)] hover:shadow-[0_0_25px_rgba(239,68,68,0.6)] hover:-translate-y-0.5 uppercase tracking-wide w-full sm:w-auto">
                     {{ __('messages.fraud_button') }}
                 </button>
             </div>
         </div>
    </div>
</div>
