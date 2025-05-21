<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportsFest 2023 - Join the Ultimate Sports Event</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
   
    <!-- Navigation Bar -->
    <div class="navbar bg-base-100 shadow-md sticky top-0 z-50">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="#about">About</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#schedule">Schedule</a></li>
                    <li><a href="#venue">Venue</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost normal-case text-xl">
                <i class="fas fa-running mr-2"></i>
                SportsFest
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="#about">About</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#schedule">Schedule</a></li>
                <li><a href="#venue">Venue</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <a href="{{ route('login') }}" class="btn btn-ghost">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero min-h-screen" style="background-image: url('https://picsum.photos/id/1058/1600/800');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">SportsFest 2023</h1>
                <p class="mb-5">Join us for the ultimate sports experience. Compete, connect, and celebrate the spirit
                    of sportsmanship.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="register.html" class="btn btn-primary">Register Now</a>
                    <a href="#schedule" class="btn btn-outline btn-secondary">View Schedule</a>
                </div>
                <div class="mt-8 bg-base-100 bg-opacity-20 p-4 rounded-lg">
                    <div class="countdown font-mono text-2xl flex justify-center">
                        <div>
                            <span style="--value:15;"></span>
                            <span class="text-xs">days</span>
                        </div>
                        <div class="mx-1">:</div>
                        <div>
                            <span style="--value:10;"></span>
                            <span class="text-xs">hours</span>
                        </div>
                        <div class="mx-1">:</div>
                        <div>
                            <span style="--value:24;"></span>
                            <span class="text-xs">min</span>
                        </div>
                        <div class="mx-1">:</div>
                        <div>
                            <span style="--value:52;"></span>
                            <span class="text-xs">sec</span>
                        </div>
                    </div>
                    <p class="text-sm mt-2">Until the event starts</p>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">About SportsFest</h2>
                <p class="text-lg max-w-3xl mx-auto">SportsFest is the premier sports event bringing together athletes
                    and enthusiasts from all over the country for a week of competition, camaraderie, and celebration.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <i class="fas fa-medal text-6xl text-primary"></i>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Competitive Events</h3>
                        <p>Participate in over 20 different sports competitions with athletes from across the nation.
                        </p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <i class="fas fa-users text-6xl text-primary"></i>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Community Building</h3>
                        <p>Connect with fellow sports enthusiasts, make new friends, and build lasting relationships.
                        </p>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <i class="fas fa-trophy text-6xl text-primary"></i>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">Prestigious Awards</h3>
                        <p>Win medals, trophies, and recognition for your athletic achievements and sportsmanship.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section id="events" class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Featured Events</h2>
                <p class="text-lg max-w-3xl mx-auto">Discover the exciting sports competitions that await you at
                    SportsFest 2023.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Event Card 1 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1058/600/400" alt="Marathon" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">
                            Marathon
                            <div class="badge badge-secondary">Popular</div>
                        </h3>
                        <p>Challenge yourself in our 42km marathon through scenic routes.</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">Endurance</div>
                            <div class="badge badge-outline">Running</div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1062/600/400" alt="Swimming" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">
                            Swimming Championship
                            <div class="badge badge-secondary">New</div>
                        </h3>
                        <p>Compete in various swimming categories in our Olympic-sized pool.</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">Aquatics</div>
                            <div class="badge badge-outline">Speed</div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1059/600/400" alt="Basketball" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">
                            Basketball Tournament
                        </h3>
                        <p>Join our 5v5 basketball tournament with teams from across the country.</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">Team Sport</div>
                            <div class="badge badge-outline">Ball Game</div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 4 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1067/600/400" alt="Cycling" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">
                            Cycling Race
                        </h3>
                        <p>Race through challenging terrains in our 100km cycling competition.</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">Outdoor</div>
                            <div class="badge badge-outline">Endurance</div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 5 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1072/600/400" alt="Tennis" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">
                            Tennis Open
                        </h3>
                        <p>Showcase your tennis skills in singles and doubles matches.</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">Racket Sport</div>
                            <div class="badge badge-outline">Precision</div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 6 -->
                <div class="card bg-base-100 shadow-xl">
                    <figure><img src="https://picsum.photos/id/1079/600/400" alt="Soccer" /></figure>
                    <div class="card-body">
                        <h3 class="card-title">
                            Soccer Championship
                            <div class="badge badge-secondary">Popular</div>
                        </h3>
                        <p>Compete in our soccer tournament with teams of all skill levels.</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">Team Sport</div>
                            <div class="badge badge-outline">Ball Game</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="events.html" class="btn btn-primary">View All Events</a>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section id="schedule" class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Event Schedule</h2>
                <p class="text-lg max-w-3xl mx-auto">Plan your SportsFest experience with our comprehensive event
                    schedule.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Event</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>June 15, 2023</td>
                            <td>8:00 AM</td>
                            <td>Opening Ceremony</td>
                            <td>Main Stadium</td>
                        </tr>
                        <tr>
                            <td>June 15, 2023</td>
                            <td>10:00 AM</td>
                            <td>Marathon</td>
                            <td>City Park</td>
                        </tr>
                        <tr>
                            <td>June 16, 2023</td>
                            <td>9:00 AM</td>
                            <td>Swimming Preliminaries</td>
                            <td>Aquatic Center</td>
                        </tr>
                        <tr>
                            <td>June 16, 2023</td>
                            <td>2:00 PM</td>
                            <td>Basketball Tournament - Day 1</td>
                            <td>Indoor Arena</td>
                        </tr>
                        <tr>
                            <td>June 17, 2023</td>
                            <td>10:00 AM</td>
                            <td>Tennis Open - Preliminaries</td>
                            <td>Tennis Courts</td>
                        </tr>
                        <tr>
                            <td>June 18, 2023</td>
                            <td>8:00 AM</td>
                            <td>Cycling Race</td>
                            <td>Mountain Trail</td>
                        </tr>
                        <tr>
                            <td>June 20, 2023</td>
                            <td>7:00 PM</td>
                            <td>Closing Ceremony & Awards</td>
                            <td>Main Stadium</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-10">
                <a href="schedule.html" class="btn btn-primary">Download Full Schedule</a>
            </div>
        </div>
    </section>

    <!-- Venue Section -->
    <section id="venue" class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Venue Information</h2>
                <p class="text-lg max-w-3xl mx-auto">All events will take place at the National Sports Complex,
                    featuring state-of-the-art facilities for all competitions.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <div class="rounded-lg overflow-hidden">
                        <img src="https://picsum.photos/id/1048/800/600" alt="Venue" class="w-full h-auto">
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-bold mb-4">National Sports Complex</h3>
                    <p class="mb-4">Our venue features modern facilities designed to international standards for all
                        sporting events.</p>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                            <p>123 Sports Avenue, Metropolis, Country</p>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-bus text-primary mt-1 mr-3"></i>
                            <p>Accessible by public transportation - Bus routes 10, 15, and 22 stop directly at the
                                venue</p>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-car text-primary mt-1 mr-3"></i>
                            <p>Ample parking available for participants and spectators</p>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-utensils text-primary mt-1 mr-3"></i>
                            <p>Food courts and refreshment stands available throughout the complex</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="venue.html" class="btn btn-primary">View Venue Map</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Benefits -->
    <section class="py-16 bg-primary text-primary-content">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Why Register?</h2>
                <p class="text-lg max-w-3xl mx-auto">Join thousands of sports enthusiasts and enjoy these exclusive
                    benefits when you register for SportsFest 2023.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card bg-base-100 text-base-content">
                    <div class="card-body items-center text-center">
                        <i class="fas fa-ticket-alt text-4xl text-primary mb-4"></i>
                        <h3 class="card-title">Priority Access</h3>
                        <p>Get priority access to all events and premium seating options.</p>
                    </div>
                </div>

                <div class="card bg-base-100 text-base-content">
                    <div class="card-body items-center text-center">
                        <i class="fas fa-tshirt text-4xl text-primary mb-4"></i>
                        <h3 class="card-title">Official Merchandise</h3>
                        <p>Receive exclusive SportsFest merchandise and participant kit.</p>
                    </div>
                </div>

                <div class="card bg-base-100 text-base-content">
                    <div class="card-body items-center text-center">
                        <i class="fas fa-utensils text-4xl text-primary mb-4"></i>
                        <h3 class="card-title">Complimentary Meals</h3>
                        <p>Enjoy complimentary meals and refreshments during the event.</p>
                    </div>
                </div>

                <div class="card bg-base-100 text-base-content">
                    <div class="card-body items-center text-center">
                        <i class="fas fa-certificate text-4xl text-primary mb-4"></i>
                        <h3 class="card-title">Participation Certificate</h3>
                        <p>Receive an official certificate of participation in SportsFest 2023.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="register.html" class="btn btn-secondary btn-lg">Register Now</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">What Participants Say</h2>
                <p class="text-lg max-w-3xl mx-auto">Hear from athletes who participated in previous SportsFest events.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center mb-4">
                            <div class="avatar">
                                <div class="w-12 rounded-full">
                                    <img src="https://api.dicebear.com/6.x/avataaars/svg?seed=John" alt="John D." />
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold">John D.</h3>
                                <p class="text-sm">Marathon Runner</p>
                            </div>
                        </div>
                        <p>"SportsFest was an incredible experience. The organization was flawless, and the atmosphere
                            was electric. Can't wait for next year!"</p>
                        <div class="mt-4 flex">
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center mb-4">
                            <div class="avatar">
                                <div class="w-12 rounded-full">
                                    <img src="https://api.dicebear.com/6.x/avataaars/svg?seed=Sarah" alt="Sarah M." />
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold">Sarah M.</h3>
                                <p class="text-sm">Tennis Player</p>
                            </div>
                        </div>
                        <p>"The level of competition was outstanding, and I made so many new friends. The facilities
                            were world-class. Highly recommend!"</p>
                        <div class="mt-4 flex">
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star-half-alt text-yellow-500"></i>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center mb-4">
                            <div class="avatar">
                                <div class="w-12 rounded-full">
                                    <img src="https://api.dicebear.com/6.x/avataaars/svg?seed=Michael"
                                        alt="Michael T." />
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold">Michael T.</h3>
                                <p class="text-sm">Basketball Team Captain</p>
                            </div>
                        </div>
                        <p>"Our team had a blast at SportsFest. The organization was top-notch, and the competition was
                            fierce but fair. We'll definitely be back!"</p>
                        <div class="mt-4 flex">
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                            <i class="fas fa-star text-yellow-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Contact Us</h2>
                <p class="text-lg max-w-3xl mx-auto">Have questions about SportsFest? Get in touch with our team.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="text-2xl font-bold mb-4">Send Us a Message</h3>
                        <form>
                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text">Name</span>
                                </label>
                                <input type="text" placeholder="Your name" class="input input-bordered" />
                            </div>

                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" placeholder="Your email" class="input input-bordered" />
                            </div>

                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text">Subject</span>
                                </label>
                                <select class="select select-bordered w-full">
                                    <option disabled selected>Select a subject</option>
                                    <option>Registration Inquiry</option>
                                    <option>Event Information</option>
                                    <option>Sponsorship Opportunity</option>
                                    <option>Volunteer Information</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text">Message</span>
                                </label>
                                <textarea class="textarea textarea-bordered h-24" placeholder="Your message"></textarea>
                            </div>

                            <div class="form-control mt-6">
                                <button class="btn btn-primary">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div>
                    <div class="card bg-base-100 shadow-xl mb-6">
                        <div class="card-body">
                            <h3 class="text-2xl font-bold mb-4">Contact Information</h3>

                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <i class="fas fa-envelope text-primary mt-1 mr-3"></i>
                                    <p>info@sportsfest2023.com</p>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-phone text-primary mt-1 mr-3"></i>
                                    <p>+1 (123) 456-7890</p>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                                    <p>123 Sports Avenue, Metropolis, Country</p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h4 class="font-bold mb-2">Follow Us</h4>
                                <div class="flex space-x-4">
                                    <a href="#" class="btn btn-circle btn-outline">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-circle btn-outline">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-circle btn-outline">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="btn btn-circle btn-outline">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="text-2xl font-bold mb-4">FAQ</h3>
                            <div class="space-y-4">
                                <div class="collapse collapse-plus bg-base-200">
                                    <input type="radio" name="my-accordion-3" checked="checked" />
                                    <div class="collapse-title font-medium">
                                        How do I register for SportsFest?
                                    </div>
                                    <div class="collapse-content">
                                        <p>You can register by clicking the "Register" button at the top of this page or
                                            by visiting our registration desk at the venue.</p>
                                    </div>
                                </div>
                                <div class="collapse collapse-plus bg-base-200">
                                    <input type="radio" name="my-accordion-3" />
                                    <div class="collapse-title font-medium">
                                        What is the registration fee?
                                    </div>
                                    <div class="collapse-content">
                                        <p>Registration fees vary by event. Please check the specific event page for
                                            detailed pricing information.</p>
                                    </div>
                                </div>
                                <div class="collapse collapse-plus bg-base-200">
                                    <input type="radio" name="my-accordion-3" />
                                    <div class="collapse-title font-medium">
                                        Can I participate in multiple events?
                                    </div>
                                    <div class="collapse-content">
                                        <p>Yes, you can register for multiple events as long as there are no scheduling
                                            conflicts.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer p-10 bg-neutral text-neutral-content">
        <div>
            <span class="footer-title">SportsFest 2023</span>
            <p class="max-w-md">The premier sports event bringing together athletes and enthusiasts from all over the
                country for a week of competition, camaraderie, and celebration.</p>
        </div>
        <div>
            <span class="footer-title">Quick Links</span>
            <a href="#about" class="link link-hover">About</a>
            <a href="#events" class="link link-hover">Events</a>
            <a href="#schedule" class="link link-hover">Schedule</a>
            <a href="#venue" class="link link-hover">Venue</a>
            <a href="#contact" class="link link-hover">Contact</a>
        </div>
        <div>
            <span class="footer-title">Legal</span>
            <a href="#" class="link link-hover">Terms of use</a>
            <a href="#" class="link link-hover">Privacy policy</a>
            <a href="#" class="link link-hover">Cookie policy</a>
        </div>
        <div>
            <span class="footer-title">Newsletter</span>
            <div class="form-control w-80">
                <label class="label">
                    <span class="label-text text-neutral-content">Enter your email to get updates</span>
                </label>
                <div class="relative">
                    <input type="text" placeholder="username@site.com"
                        class="input input-bordered w-full pr-16 text-base-content" />
                    <button class="btn btn-primary absolute top-0 right-0 rounded-l-none">Subscribe</button>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer footer-center p-4 bg-base-300 text-base-content">
        <div>
            <p>Copyright © 2023 - All rights reserved by SportsFest Organization</p>
        </div>
    </div>
</body>

</html>
