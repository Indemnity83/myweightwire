@extends('layouts.guest')

@section('body')
<div class="bg-grey-lightest pt-10 min-h-screen">
    <div class="max-w-lg mx-auto pb-12">
        <div class="flex mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" height="50" viewBox="-16 0 480 480" class="mr-2 text-purple-dark fill-current" style="transform: rotate(-12.5deg);"><path d="M448 424V56c-.035-30.914-25.086-55.965-56-56H56C25.086.035.035 25.086 0 56v368c.035 30.914 25.086 55.965 56 56h336c30.914-.035 55.965-25.086 56-56zm-432 0V56c.027-22.082 17.918-39.973 40-40h336c22.082.027 39.973 17.918 40 40v368c-.027 22.082-17.918 39.973-40 40H56c-22.082-.027-39.973-17.918-40-40zm0 0"></path><path d="M416 424V56c-.016-13.25-10.75-23.984-24-24H56c-13.25.016-23.984 10.75-24 24v368c.016 13.25 10.75 23.984 24 24h336c13.25-.016 23.984-10.75 24-24zm-360 8a8.005 8.005 0 0 1-8-8V56a8.005 8.005 0 0 1 8-8h336a8.005 8.005 0 0 1 8 8v368a8.005 8.005 0 0 1-8 8zm0 0"/><path d="M80 192h288a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8H80a8 8 0 0 0-8 8v112a8 8 0 0 0 8 8zm8-112h27.055l13.789 27.578a8 8 0 0 0 10.734 3.578 8 8 0 0 0 3.578-10.734L132.946 80H216v16a8 8 0 0 0 16 0V80h83.055l-10.211 20.422a8 8 0 0 0 3.578 10.734 8 8 0 0 0 10.734-3.578L332.946 80H360v96H227.312l-53.656-53.656A8 8 0 0 0 160 128v24a8 8 0 0 0 16 0v-4.688L204.688 176H88zm0 0M224 208a8 8 0 0 0-8 8v16a8 8 0 0 0 16 0v-16a8 8 0 0 0-8-8zm0 0M224 256a8 8 0 0 0-8 8v144a8 8 0 0 0 16 0V264a8 8 0 0 0-8-8zm0 0M152.336 267.945l-16.399-2.73a31.88 31.88 0 0 0-17.14 1.851l-11.961 4.782v.004c-16.086 6.535-24.086 24.652-18.086 40.945l14.234 37.95a15.973 15.973 0 0 1 1.016 5.605V376c0 17.672 14.328 32 32 32s32-14.328 32-32v-21.367c.004-1.168.133-2.328.383-3.469l9.937-44.71a32.006 32.006 0 0 0-4.718-24.837 32.004 32.004 0 0 0-21.266-13.672zm10.36 35.04l-9.938 44.73a32.44 32.44 0 0 0-.758 6.918V376c0 8.836-7.164 16-16 16s-16-7.164-16-16v-19.648a31.803 31.803 0 0 0-2.04-11.235l-14.226-37.937c-3.004-8.145.996-17.207 9.04-20.477l11.968-4.781a15.942 15.942 0 0 1 8.57-.926l16.399 2.73a15.998 15.998 0 0 1 12.984 19.258zm0 0M98.344 242.344a7.997 7.997 0 0 0 0 11.312l8 8a7.998 7.998 0 0 0 11.304-.008 7.998 7.998 0 0 0 .008-11.304l-8-8a7.997 7.997 0 0 0-11.312 0zm0 0M128 240v8a8 8 0 0 0 16 0v-8a8 8 0 0 0-16 0zm0 0M162.344 242.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0M93.656 277.656a7.997 7.997 0 0 0 0-11.312l-8-8a7.998 7.998 0 0 0-11.304.008 7.998 7.998 0 0 0-.008 11.304l8 8a7.997 7.997 0 0 0 11.312 0zm0 0M341.164 271.852v-.004l-11.953-4.778a31.873 31.873 0 0 0-17.149-1.855l-16.398 2.73a32.004 32.004 0 0 0-21.266 13.672 32.006 32.006 0 0 0-4.718 24.836l9.937 44.692c.25 1.144.38 2.316.383 3.488V376c0 17.672 14.328 32 32 32s32-14.328 32-32v-19.648c0-1.918.344-3.82 1.023-5.618l14.227-37.937c6-16.293-2-34.41-18.086-40.945zm3.102 35.328l-14.22 37.925A31.684 31.684 0 0 0 328 356.352V376c0 8.836-7.164 16-16 16s-16-7.164-16-16v-21.367a32.621 32.621 0 0 0-.758-6.938l-9.937-44.71a16.002 16.002 0 0 1 12.984-19.258l16.399-2.73c.87-.145 1.75-.22 2.632-.22 2.035 0 4.055.391 5.946 1.149l11.96 4.777c8.044 3.27 12.044 12.332 9.04 20.477zm0 0M338.344 242.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0M304 240v8a8 8 0 0 0 16 0v-8a8 8 0 0 0-16 0zm0 0M274.344 242.344a7.997 7.997 0 0 0 0 11.312l8 8a7.998 7.998 0 0 0 11.304-.008 7.998 7.998 0 0 0 .008-11.304l-8-8a7.997 7.997 0 0 0-11.312 0zm0 0M362.344 258.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0"/></svg>
            <h1>Terms and Conditions ("Terms")</h1>
        </div>

        <p class="text-sm mb-4">Last updated: December 21, 2018</p>


        <p class="mb-4">Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the https://myweightwire.com website (the "Service") operated by WeightWire ("us", "we", or "our").</p>

        <p class="mb-4">Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>

        <p class="mb-4">By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service. The Terms and Conditions agreement  for WeightWire is based on the <a class="text-grey-darker hover:text-grey" href="https://termsfeed.com/blog/sample-terms-and-conditions-template/">TermsFeed's Terms and Conditions Template</a>.</p>


        <h2 class="mt-6 mb-4">Accounts</h2>

        <p class="mb-4">When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>

        <p class="mb-4">You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>

        <p class="mb-4">You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>


        <h2 class="mt-6 mb-4">Links To Other Web Sites</h2>

        <p class="mb-4">Our Service may contain links to third-party web sites or services that are not owned or controlled by WeightWire.</p>

        <p class="mb-4">WeightWire has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that WeightWire shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>

        <p class="mb-4">We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>


        <h2 class="mt-6 mb-4">Termination</h2>

        <p class="mb-4">We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

        <p class="mb-4">All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>

        <p class="mb-4">We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

        <p class="mb-4">Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service.</p>

        <p class="mb-4">All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>


        <h2 class="mt-6 mb-4">Governing Law</h2>

        <p class="mb-4">These Terms shall be governed and construed in accordance with the laws of California, United States, without regard to its conflict of law provisions.</p>

        <p class="mb-4">Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>


        <h2 class="mt-6 mb-4">Changes</h2>

        <p class="mb-4">We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 15 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

        <p class="mb-4">By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>


        <h2 class="mt-6 mb-4">Contact Us</h2>

        <p class="mb-4">If you have any questions about these Terms, please contact us.</p>
    </div>
</div>
@endsection