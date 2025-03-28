@extends($activeTemplate . 'layouts.frontend')
@section('content')

@include($activeTemplate . 'partials.breadcrumb')
<!-- ====== start contact ====== -->
@php
$contactContent = getContent('contact.content', true);
$addressContent = getContent('address.content', true);
$user = auth()->user();
@endphp

<!-- PAGE
============================================= -->
<section id="contacts-3" class="bg-lightgrey wide-60 contacts-section division">
    <div class="container">
        <!-- Privacy Policy -->
        <div class="privacy-policy">
            <h2>Privacy Policy</h2>
            <p style="text-align: justify;">At <strong>LTechNG</strong>, accessible from <strong>LTechNG.co</strong>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by <strong>LTechNG</strong> and how we use it. If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us. This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in <strong>LTechNG</strong>. This policy is not applicable to any information collected offline or via channels other than this website.</p>

            <h3>Consent</h3>
            <p style="text-align: justify;">By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

            <h3>Information we collect</h3>
            <p style="text-align: justify;">The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information. If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide. When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

            <h3>How we use our information</h3>
            <ul style="list-style-type:disc">
                <li style="text-align: justify;">Provide, operate, and maintain our website</li>
                <li style="text-align: justify;">Improve, personalize, and expand our website</li>
                <li style="text-align: justify;">Understand and analyze how you use our website</li>
                <li style="text-align: justify;">Develop new products, services, features, and functionality</li>
                <li style="text-align: justify;">Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
                <li style="text-align: justify;">Send you emails</li>
                <li style="text-align: justify;">Find and prevent fraud</li>
                <li style="text-align: justify;">Log Files</li>
            </ul>

            <h3>Advertising Partners Privacy Policies</h3>
            <p style="text-align: justify;">You may consult this list to find the Privacy Policy for each of the advertising partners of <strong>LTechNG</strong>. Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on <strong>LTechNG</strong>, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit. Note that <strong>LTechNG</strong> has no access to or control over these cookies that are used by third-party advertisers.</p>

            <h3>Third Party Privacy Policies</h3>
            <p style="text-align: justify;"><strong>LTechNG</strong>'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

            <h3>CCPA Privacy Rights (Do Not Sell My Personal Information)</h3>
            <ul style="list-style-type:disc">
                <li style="text-align: justify;">Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</li>
                <li style="text-align: justify;">Request that a business delete any personal data about the consumer that a business has collected.</li>
                <li style="text-align: justify;">Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</li>
            </ul>
            <p style="text-align: justify;">If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

            <h3>GDPR Data Protection Rights</h3>
            <p style="text-align: justify;">We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
            <ul style="list-style-type:disc">
                <li style="text-align: justify;">The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</li>
                <li style="text-align: justify;">The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete</li>
                <li style="text-align: justify;">The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</li>
                <li style="text-align: justify;">The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</li>
                <li style="text-align: justify;">The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</li>
                <li style="text-align: justify;">The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</li>
            </ul>
            <p style="text-align: justify;">If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

            <h3>Children's Information</h3>
            <p style="text-align: justify;">Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity. <strong>LTechNG</strong> does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>

            <h3>Deletion of Account and Data Retention</h3>
            <p style="text-align: justify;">When you choose to delete your <strong>LTechNG</strong> account, we ensure your data privacy is upheld as our foremost priority. Upon the receipt of an account deletion request, we immediately begin the process to remove your personal information from our systems.</p>
            <p style="text-align: justify;">Your data, once deleted, is permanently erased from our databases and backup systems in accordance with our data deletion procedures and data retention policy. We adhere to stringent standards to prevent any accidental loss or unauthorized access of your personal information.</p>
            <p style="text-align: justify;"><strong>LTechNG</strong> does not retain any copies of your information after your account deletion, except as required by law or to satisfy our legal obligations.</p>

            <h3>Re-registration with Previously Deleted Information</h3>
            <p style="text-align: justify;">In line with our commitment to your privacy and data security, if you decide to re-register with <strong>LTechNG</strong>, you must do so as a new user. We will not allow for the reuse of personal information that has been previously deleted. You will be required to provide your information afresh during the re-registration process. This is to ensure that we respect the choices you make about your data and to prevent any potential misuse of previously deleted information.</p>
        </div>
        <!-- End Privacy Policy -->
    </div>
    <!-- End container -->
</section>
<!-- END CONTACTS-3 -->

@endsection
