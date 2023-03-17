@push('scripts')
    <script>
        const publishForms = document.querySelectorAll('.publishForm');
        const publishSwitches = document.querySelectorAll('.publishSwitch');
        publishSwitches.forEach((publishSwitch, index) => {
            publishSwitch.addEventListener('change', () => {
                publishForms[index].submit();
            });
        });
      </script>
    @endpush
