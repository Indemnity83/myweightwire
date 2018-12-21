@extends('layouts.guest')

@section('body')
<div class="bg-grey-lightest pt-10 min-h-screen">
    <div class="max-w-lg mx-auto pb-12">
        <div class="flex mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" height="50" viewBox="-16 0 480 480" class="mr-2 text-purple-dark fill-current" style="transform: rotate(-12.5deg);"><path d="M448 424V56c-.035-30.914-25.086-55.965-56-56H56C25.086.035.035 25.086 0 56v368c.035 30.914 25.086 55.965 56 56h336c30.914-.035 55.965-25.086 56-56zm-432 0V56c.027-22.082 17.918-39.973 40-40h336c22.082.027 39.973 17.918 40 40v368c-.027 22.082-17.918 39.973-40 40H56c-22.082-.027-39.973-17.918-40-40zm0 0"></path><path d="M416 424V56c-.016-13.25-10.75-23.984-24-24H56c-13.25.016-23.984 10.75-24 24v368c.016 13.25 10.75 23.984 24 24h336c13.25-.016 23.984-10.75 24-24zm-360 8a8.005 8.005 0 0 1-8-8V56a8.005 8.005 0 0 1 8-8h336a8.005 8.005 0 0 1 8 8v368a8.005 8.005 0 0 1-8 8zm0 0"/><path d="M80 192h288a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8H80a8 8 0 0 0-8 8v112a8 8 0 0 0 8 8zm8-112h27.055l13.789 27.578a8 8 0 0 0 10.734 3.578 8 8 0 0 0 3.578-10.734L132.946 80H216v16a8 8 0 0 0 16 0V80h83.055l-10.211 20.422a8 8 0 0 0 3.578 10.734 8 8 0 0 0 10.734-3.578L332.946 80H360v96H227.312l-53.656-53.656A8 8 0 0 0 160 128v24a8 8 0 0 0 16 0v-4.688L204.688 176H88zm0 0M224 208a8 8 0 0 0-8 8v16a8 8 0 0 0 16 0v-16a8 8 0 0 0-8-8zm0 0M224 256a8 8 0 0 0-8 8v144a8 8 0 0 0 16 0V264a8 8 0 0 0-8-8zm0 0M152.336 267.945l-16.399-2.73a31.88 31.88 0 0 0-17.14 1.851l-11.961 4.782v.004c-16.086 6.535-24.086 24.652-18.086 40.945l14.234 37.95a15.973 15.973 0 0 1 1.016 5.605V376c0 17.672 14.328 32 32 32s32-14.328 32-32v-21.367c.004-1.168.133-2.328.383-3.469l9.937-44.71a32.006 32.006 0 0 0-4.718-24.837 32.004 32.004 0 0 0-21.266-13.672zm10.36 35.04l-9.938 44.73a32.44 32.44 0 0 0-.758 6.918V376c0 8.836-7.164 16-16 16s-16-7.164-16-16v-19.648a31.803 31.803 0 0 0-2.04-11.235l-14.226-37.937c-3.004-8.145.996-17.207 9.04-20.477l11.968-4.781a15.942 15.942 0 0 1 8.57-.926l16.399 2.73a15.998 15.998 0 0 1 12.984 19.258zm0 0M98.344 242.344a7.997 7.997 0 0 0 0 11.312l8 8a7.998 7.998 0 0 0 11.304-.008 7.998 7.998 0 0 0 .008-11.304l-8-8a7.997 7.997 0 0 0-11.312 0zm0 0M128 240v8a8 8 0 0 0 16 0v-8a8 8 0 0 0-16 0zm0 0M162.344 242.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0M93.656 277.656a7.997 7.997 0 0 0 0-11.312l-8-8a7.998 7.998 0 0 0-11.304.008 7.998 7.998 0 0 0-.008 11.304l8 8a7.997 7.997 0 0 0 11.312 0zm0 0M341.164 271.852v-.004l-11.953-4.778a31.873 31.873 0 0 0-17.149-1.855l-16.398 2.73a32.004 32.004 0 0 0-21.266 13.672 32.006 32.006 0 0 0-4.718 24.836l9.937 44.692c.25 1.144.38 2.316.383 3.488V376c0 17.672 14.328 32 32 32s32-14.328 32-32v-19.648c0-1.918.344-3.82 1.023-5.618l14.227-37.937c6-16.293-2-34.41-18.086-40.945zm3.102 35.328l-14.22 37.925A31.684 31.684 0 0 0 328 356.352V376c0 8.836-7.164 16-16 16s-16-7.164-16-16v-21.367a32.621 32.621 0 0 0-.758-6.938l-9.937-44.71a16.002 16.002 0 0 1 12.984-19.258l16.399-2.73c.87-.145 1.75-.22 2.632-.22 2.035 0 4.055.391 5.946 1.149l11.96 4.777c8.044 3.27 12.044 12.332 9.04 20.477zm0 0M338.344 242.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0M304 240v8a8 8 0 0 0 16 0v-8a8 8 0 0 0-16 0zm0 0M274.344 242.344a7.997 7.997 0 0 0 0 11.312l8 8a7.998 7.998 0 0 0 11.304-.008 7.998 7.998 0 0 0 .008-11.304l-8-8a7.997 7.997 0 0 0-11.312 0zm0 0M362.344 258.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0"/></svg>
            <h1>Privacy Policy</h1>
        </div>

        <p class="text-sm mb-4">Effective date: December 21, 2018</p>
        
        
        <p class="mb-4">Kyle Klaus ("us", "we", or "our") operates the https://myweightwire.com website (hereinafter referred to as the "Service").</p>
        
        <p class="mb-4">This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data. Our Privacy Policy  for WeightWire is based on the <a class="text-grey-darker hover:text-grey" href="https://privacypolicies.com/blog/privacy-policy-template/">Privacy Policy Template from Privacy Policies</a>.</p>
        
        <p class="mb-4">We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, the terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from <a class="text-grey-darker hover:text-grey" href="/terms">https://myweightwire.com/terms</a></p>
        
        
        <h2 class="mt-6 mb-4">Information Collection And Use</h2>
        
        <p class="mb-4">We collect several different types of information for various purposes to provide and improve our Service to you.</p>
        
        <h3 class="mb-4">Types of Data Collected</h3>
        
        <h4 class="mb-2">Personal Data</h4>
        
        <p class="mb-4">While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). Personally identifiable information may include, but is not limited to:</p>
        
        <ul class="mb-6">
            <li>Email address</li>
            <li>Body Weight</li>
            <li>Cookies and Usage Data</li>
        </ul>
        
        <h4 class="mb-2">Usage Data</h4>
        
        <p class="mb-4">We may also collect information on how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>
        
        <h4 class="mb-2">Tracking & Cookies Data</h4>
        <p class="mb-4">We use cookies and similar tracking technologies to track the activity on our Service and hold certain information.</p>
        <p class="mb-4">Cookies are files with small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Tracking technologies also used are beacons, tags, and scripts to collect and track information and to improve and analyze our Service.</p>
        <p class="mb-4">You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service. You can learn more how to manage cookies in the <a class="text-grey-darker hover:text-grey" href="https://privacypolicies.com/blog/how-to-delete-cookies/">Browser Cookies Guide</a>.</p>
        <p class="mb-4">Examples of Cookies we use:</p>
        <ul class="mb-6">
            <li><strong>Session Cookies.</strong> We use Session Cookies to operate our Service.</li>
            <li><strong>Preference Cookies.</strong> We use Preference Cookies to remember your preferences and various settings.</li>
            <li><strong>Security Cookies.</strong> We use Security Cookies for security purposes.</li>
        </ul>
        
        <h2 class="mt-6 mb-4">Use of Data</h2>
            
        <p class="mb-4">WeightWire uses the collected data for various purposes:</p>    
        <ul class="mb-6">
            <li>To provide and maintain the Service</li>
            <li>To notify you about changes to our Service</li>
            <li>To allow you to participate in interactive features of our Service when you choose to do so</li>
            <li>To provide customer care and support</li>
            <li>To provide analysis or valuable information so that we can improve the Service</li>
            <li>To monitor the usage of the Service</li>
            <li>To detect, prevent and address technical issues</li>
        </ul>
        
        <h2 class="mt-6 mb-4">Transfer Of Data</h2>
        <p class="mb-4">Your information, including Personal Data, may be transferred to — and maintained on — computers located outside of your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from your jurisdiction.</p>
        <p class="mb-4">If you are located outside United States and choose to provide information to us, please note that we transfer the data, including Personal Data, to United States and process it there.</p>
        <p class="mb-4">Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
        <p class="mb-4">WeightWire will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of your data and other personal information.</p>
        
        <h2 class="mt-6 mb-4">Disclosure Of Data</h2>
        
        <h3 class="mb-4">Legal Requirements</h3>
        <p class="mb-4">WeightWire may disclose your Personal Data in the good faith belief that such action is necessary to:</p>
        <ul class="mb-6">
            <li>To comply with a legal obligation</li>
            <li>To protect and defend the rights or property of WeightWire</li>
            <li>To prevent or investigate possible wrongdoing in connection with the Service</li>
            <li>To protect the personal safety of users of the Service or the public</li>
            <li>To protect against legal liability</li>
        </ul>
        
        <h2 class="mt-6 mb-4">Security Of Data</h2>
        <p class="mb-4">The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>
        
        <h2 class="mt-6 mb-4">Service Providers</h2>
        <p class="mb-4">We may employ third party companies and individuals to facilitate our Service ("Service Providers"), to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</p>
        <p class="mb-4">These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>
        
        
        
        <h2 class="mt-6 mb-4">Links To Other Sites</h2>
        <p class="mb-4">Our Service may contain links to other sites that are not operated by us. If you click on a third party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
        <p class="mb-4">We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>
        
        
        <h2 class="mt-6 mb-4">Children's Privacy</h2>
        <p class="mb-4">Our Service does not address anyone under the age of 18 ("Children").</p>
        <p class="mb-4">We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Children has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</p>
        
        
        <h2 class="mt-6 mb-4">Changes To This Privacy Policy</h2>
        <p class="mb-4">We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
        <p class="mb-4">We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the "effective date" at the top of this Privacy Policy.</p>
        <p class="mb-4">You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
        
        
        <h2 class="mt-6 mb-4">Contact Us</h2>
        <p class="mb-4">If you have any questions about this Privacy Policy, please contact us:</p>
        <ul class="mb-6">
                <li>By email: kklaus@indemnity83.com</li>
                  
                <li>By phone number: 9166737858</li>
                </ul>
    </div>
</div>
@endsection