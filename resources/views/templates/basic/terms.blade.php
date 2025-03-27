@extends(checkTemplate() . 'layouts.frontend')
@section('content')

@include(checkTemplate() . 'partials.breadcrumb')
<!-- ====== Website Terms and Conditions of Use ====== -->
@php
$contactContent = getContent('contact.content', true);
$addressContent = getContent('address.content', true);
$user = auth()->user();
@endphp

<!-- PAGE
============================================= -->
<section id="contacts-3" class="bg-lightgrey wide-60 contacts-section division">
    <div class="container">

        <!-- SECTION TITLE -->
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="section-title text-center mb-60">

                    <!-- Title 	-->
                    <h2 class="h2-xs">Website Terms and Conditions of Use</h2>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <!-- TERMS -->
                <div class="terms-container">
                    <h3 class="h3-xs">Terms</h3>
                    <p class="justify-text">
                        By accessing this Website, accessible from LTechNG, you are agreeing to be bound by these Website Terms and Conditions of Use and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The materials contained in this Website are protected by copyright and trade mark law.
                    </p>
                </div>

                <!-- Use License -->
                <div class="terms-container">
                    <h3 class="h3-xs">Use License</h3>
                    <p class="justify-text">
                        Permission is granted to temporarily download one copy of the materials on LTechNG's Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                    </p>
                        <ul style="list-style-type:square;">
                        <li>Modify or copy the materials;</li>
                        <li>Use the materials for any commercial purpose or for any public display;</li>
                        <li>Attempt to reverse engineer any software contained on LTechNG's Website;</li>
                        <li>Remove any copyright or other proprietary notations from the materials; or</li>
                        <li>Transferring the materials to another person or "mirror" the materials on any other server.</li>
                        </ul>
                    <p class="justify-text">
                        This will let LTechNG to terminate upon violations of any of these restrictions. Upon termination, your viewing right will also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format. These Terms of Service has been created with the help of the Terms Of Service Generator.
                    </p>
                </div>

                <!-- Disclaimer -->
                <div class="terms-container">
                    <h3 class="h3-xs">Disclaimer</h3>
                    <p class="justify-text">
                        All the materials on LTechNG’s Website are provided "as is". LTechNG makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, LTechNG does not make any representations concerning the accuracy or reliability of the use of the materials on its Website or otherwise relating to such materials or any sites linked to this Website.
                    </p>
                </div>

                <!-- Limitations -->
                <div class="terms-container">
                    <h3 class="h3-xs">Limitations</h3>
                    <p class="justify-text">
                        LTechNG or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the materials on LTechNG’s Website, even if LTechNG or an authorize representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or limitations of liability for incidental damages, these limitations may not apply to you.
                    </p>
                </div>

                <!-- Revisions and Errata -->
                <div class="terms-container">
                    <h3 class="h3-xs">Revisions and Errata</h3>
                    <p class="justify-text">
                        The materials appearing on LTechNG’s Website may include technical, typographical, or photographic errors. LTechNG will not promise that any of the materials in this Website are accurate, complete, or current. LTechNG may change the materials contained on its Website at any time without notice. LTechNG does not make any commitment to update the materials.
                    </p>
                </div>

                <!-- Links -->
                <div class="terms-container">
                    <h3 class="h3-xs">Links</h3>
                    <p class="justify-text">
                        LTechNG has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked site. The presence of any link does not imply endorsement by LTechNG of the site. The use of any linked website is at the user’s own risk.
                    </p>
                </div>

                <!-- Site Terms of Use Modifications -->
                <div class="terms-container">
                    <h3 class="h3-xs">Site Terms of Use Modifications</h3>
                    <p class="justify-text">
                        LTechNG may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.
                    </p>
                </div>

                <!-- Your Privacy -->
                <div class="terms-container">
                    <h3 class="h3-xs">Your Privacy</h3>
                    <p class="justify-text">
                        Please read our Privacy Policy.
                    </p>
                </div>

                <!-- Governing Law -->
                <div class="terms-container">
                    <h3 class="h3-xs">Governing Law</h3>
                    <p class="justify-text">
                        Any claim related to LTechNG's Website shall be governed by the laws of ng without regards to its conflict of law provisions.
                    </p>
                </div>

            </div>
        </div>

    </div>	   <!-- End container -->
</section>	<!-- END CONTACTS-3 -->

@endsection
