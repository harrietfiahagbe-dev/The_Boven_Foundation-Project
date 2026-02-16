THE BOVEN FOUNDATION WEBSITE
Product Requirements Document (PRD)
A Beginner's Complete Project Blueprint
Version: 1.0  |  Status: Draft  |  Year: 2025
 
1. Project Overview
This document is the full blueprint for building The Boven Foundation's website. It explains what pages the site will have, what content goes on each page, and how everything should work together. As a first-time developer, you can treat this document like a recipe, follow it step by step, and you'll end up with a real, professional website by the end.

What is an NGO Website?
An NGO (Non-Governmental Organization) website is the online home of your organization. It tells the world who you are, what you stand for, and what you've accomplished. Think of it like a digital brochure that's available to anyone in the world, 24 hours a day.

1.1  Project Name
THE BOVEN FOUNDATION — Official Website
1.2  Project Goal
To build a clean, informative, and professional landing website for your NGO that introduces your organisation to the world. The site should communicate your mission, showcase your leadership team, highlight completed projects, and make it easy for visitors to contact you or get involved.
1.3  Why Are We Building This?
•	To give your NGO a credible online presence
•	To attract donors, volunteers, and partners
•	To showcase the work and impact your organization has already done
•	To practise and learn real web development skills
•	To have a foundation you can expand and improve over time

2. Target Audience
Before building any website, you need to understand who will be visiting it. This helps you decide what to write, what photos to use, and how to organise information. Here are the three main types of people who will visit your NGO's website:

Audience Type	Who They Are & What They Need
Donors & Funders	Individuals, companies, or foundations looking to donate money. They want to see your mission, your impact, and proof that you use funds responsibly. They need a donation or contact link.
Volunteers & Job Seekers	People who want to give their time or skills to your cause. They need to understand your work quickly and find an easy way to reach out.
Partners & Organizations	Other NGOs, government agencies, or companies looking to collaborate. They want to see your track record, your leadership, and how to get in touch.
General Public	People who are curious about your cause: students, researchers, community members. They want to understand your mission and follow your work.

3. Tech Stack (Tools You Will Use)
A 'tech stack' is just a fancy way of saying: what tools and languages will you use to build the site? Since you are learning and using Cursor (an AI-powered code editor), here is the recommended beginner stack:

Tool / Technology	What It Does & Why You're Using It
HTML	The skeleton of every web page. It defines the structure, headings, paragraphs, images, links, buttons. Every website starts with HTML.
CSS	The styling layer. It controls how things look , colors, fonts, spacing, layout. Without CSS, websites look like plain text documents.
JavaScript	Adds interactivity,  like a mobile menu that opens when you click it, or a smooth scroll effect. You'll use very basic JS to start.
Cursor (AI Code Editor)	Your main tool for writing code. It's like VS Code but with AI built in. You can ask it questions, get suggestions, and generate code blocks.
GitHub Pages / Netlify	Free hosting services where you can 'publish' your website so anyone in the world can see it. No cost, no complex setup.
Google Fonts	A free library of beautiful fonts you can add to your site to make it look professional without paying anything.
Figma (Optional)	A free design tool you can use to sketch out how pages should look before coding them. Great for beginners.

Beginner Tip — Start Simple!
You do NOT need to learn everything at once. Start with HTML and CSS only. Once your pages look good and have real content, THEN add JavaScript for small effects. This approach builds real skills step by step and avoids overwhelm.

4. Site Structure (Pages & Navigation)
Your website will be a single-page website, meaning everything lives on ONE long page that visitors scroll through. This is the most common and beginner-friendly format for landing pages. Here are all the sections your page will contain, in order from top to bottom:

Section #	Section Name
Section 1	Navigation Bar (Nav)
Section 2	Hero / Banner
Section 3	About Us
Section 4	Our Mission & Values
Section 5	Our Team / Leadership
Section 6	Our Projects
Section 7	Impact / Statistics
Section 8	Partners & Supporters
Section 9	Get Involved / Call to Action
Section 10	Contact Us
Section 11	Footer

5. Detailed Section Requirements
This is the most important part of the PRD. For every section of your website, we'll explain exactly what content it needs, what it should look like, and tips for building it.
5.1  Navigation Bar (Nav)
The navigation bar (or 'navbar') sits at the very top of the page. It stays visible as users scroll — this is called a 'sticky' navbar. It helps visitors jump to any section instantly.
Content Required:
•	Your NGO logo (or just the name in text if you don't have a logo yet)
•	Navigation links: About | Mission | Team | Projects | Impact | Contact
•	A 'Donate' or 'Get Involved' button in a standout color
Design Notes:
•	Background color: white or your NGO's brand color
•	The nav should stay at the top of the screen as the user scrolls (position: sticky in CSS)
•	On mobile phones, the links should collapse into a 'hamburger' menu (three horizontal lines)

5.2  Hero / Banner Section
The 'hero' is the very first thing visitors see when the page loads. It's the big, impactful section at the top. It needs to immediately communicate who you are and what you do in a single glance.
Content Required:
•	A large background image (a powerful photo related to your NGO's work)
•	A main headline — one short, bold sentence summarizing your mission (e.g., 'Empowering Communities Through Education and Action')
•	A one-sentence subheadline giving a little more detail
•	Two buttons: 'Learn More' (scrolls down the page) and 'Get Involved' (scrolls to contact section)
Design Notes:
•	The background image should have a semi-transparent dark overlay so the white text is readable
•	The text should be centered or left-aligned and very large
•	This section should be tall — at least the full height of the screen (100vh in CSS)

5.3  About Us Section
This section tells your organization's story. Visitors who scroll past the hero want to know more about who you are. Keep it honest, human, and concise.
Content Required:
•	A short paragraph (3–5 sentences) about when your NGO was founded and why
•	Another short paragraph about what you do and who you serve
•	A relevant photo of your team or community work (displayed beside the text)
•	Optional: Key founding stats — 'Founded in 2019 | Serving 3 communities | 200+ beneficiaries'
Layout:
•	Two-column layout on desktop: text on the left, image on the right
•	Single column (text then image stacked) on mobile

5.4  Our Mission & Values Section
Donors and partners especially want to know your core principles. This section explains your mission statement and the values that guide your work.
Content Required:
•	A clear one-paragraph Mission Statement (what you do, for whom, and why)
•	A Vision Statement (what the world looks like if you succeed)
•	3 to 5 core values, each with a short description. For example: Integrity — We are transparent in everything we do.
Design Notes:
•	Values can be displayed in a row of cards (boxes), each with an icon or emoji, a bold title, and 1–2 sentences
•	Use a light-colored background (like light grey) to visually separate this section from the ones around it

5.5  Our Team / Leadership Section
People trust organizations when they can see the real humans behind them. This section introduces your leadership team.
Content Required (per team member):
•	A professional photo (headshot or clear photo)
•	Full name
•	Title / Role (e.g., Executive Director, Program Manager)
•	2–3 sentence biography
•	Optional: LinkedIn profile link
Layout:
•	Display team members in a grid: 3 or 4 per row on desktop, 1 per row on mobile
•	Each person is shown in a 'card' — a white box with the photo at the top, name and title below, and bio text

5.6  Our Projects Section
This is one of the most important sections for credibility. It shows what your NGO has actually done. Even if you only have 1 or 2 projects, showcase them well.
Content Required (per project):
•	Project name / title
•	A photo or banner image for the project
•	A short description (what was done, where, and how many people it reached)
•	The year it was completed or its current status (Completed / Ongoing)
•	Optional: A 'Read More' link that could go to a separate page in the future
Layout:
•	Project cards in a grid, 2 or 3 per row on desktop
•	Each card has the image on top, project name and status badge below, then description
Status Badges:
•	Green badge for 'Completed'
•	Blue badge for 'Ongoing'

5.7  Impact / Statistics Section
Numbers tell a powerful story. This section highlights the measurable impact your NGO has made. Even small numbers are worth showing — they prove you're doing real work.
Content Required:
•	3 to 5 big statistics — displayed as large numbers with labels. Examples:
•	500+ Beneficiaries Reached
•	12 Communities Served
•	5 Projects Completed
•	3 Partner Organizations
Design Notes:
•	Use a bold, high-contrast background (your NGO's primary color with white text)
•	Display stats in a horizontal row of boxes, centered
•	Make the numbers large and bold so they stand out immediately

5.8  Partners & Supporters Section
If your NGO has worked with any partner organizations, government bodies, sponsors, or donor organizations — showcase them here. This adds credibility.
Content Required:
•	Partner organization names and/or logos
•	Optional: A short sentence about the partnership
Design Notes:
•	Display logos in a row on a neutral background
•	If you have no partners yet, you can skip this section or replace it with 'Media Mentions' or simply leave a placeholder

5.9  Get Involved / Call to Action Section
A 'Call to Action' (CTA) is a prompt that encourages visitors to do something. This section directly asks people to donate, volunteer, or partner with you.
Content Required:
•	A bold headline — e.g., 'Ready to Make a Difference?'
•	2–3 sentences about why someone should join or support your cause
•	Two or three action buttons: 'Donate Now', 'Volunteer With Us', 'Partner With Us'
Design Notes:
•	Use a strong background color to make this section stand out
•	Buttons should be large and clearly visible

5.10  Contact Us Section
This section gives visitors a way to reach your organization. Keep it simple and functional.
Content Required:
•	A contact form with fields: Name, Email Address, Subject, Message, and a Submit button
•	Your NGO's email address (displayed as a link)
•	Your physical address or city/country of operation
•	Optional: Phone number, WhatsApp link, social media links
Technical Note for Beginners:
To make the form actually send emails without needing a server, you can use a free service called Formspree (formspree.io). You just paste their code into your form and it handles everything.

5.11  Footer
The footer sits at the very bottom of every page. It's the last thing visitors see, and it often contains quick navigation links and legal text.
Content Required:
•	Your NGO's logo or name
•	A short one-line mission statement or tagline
•	Quick links: About | Projects | Team | Contact
•	Social media icons linking to your profiles (Facebook, Instagram, LinkedIn, Twitter/X)
•	Copyright notice: e.g., © 2025 [Your NGO Name]. All Rights Reserved.

6. Design Guidelines
Even without a professional designer, you can make your site look great by following consistent rules. These are called design guidelines.
6.1  Colors
Choose 2 main colors and 1 accent color. All buttons, headings, and highlights use these consistently. Suggested NGO-appropriate palette:

Color Role	Suggestion & Purpose
Primary Color	Deep Green (#1B5E20) — represents growth, hope, and nature. Used for buttons, headings.
Secondary Color	White (#FFFFFF) — used for backgrounds and text on dark surfaces.
Accent Color	Golden Yellow (#F9A825) — used for 'Donate' buttons and call-to-action highlights.
Background	Light Grey (#F5F5F5) — used for alternating section backgrounds so sections feel separated.
Body Text	Dark Charcoal (#212121) — easy to read on light backgrounds.

6.2  Typography (Fonts)
•	Heading Font: Montserrat (Bold) — strong and modern
•	Body Font: Open Sans (Regular) — clean and easy to read
•	Both are free from Google Fonts (fonts.google.com)
•	Heading size: 32–48px | Subheadings: 22–28px | Body text: 16–18px
6.3  Images
•	Use real photos of your team and work — stock photos feel fake on NGO sites
•	If you need free high-quality stock photos, use Unsplash (unsplash.com) or Pexels (pexels.com)
•	All images should be compressed before adding to the website (use squoosh.app — it's free)
•	Never use images with watermarks

7. Content Checklist
Below is everything you need to gather BEFORE you start coding. Collect all of this first so you're not stopping and starting while building.

Content Item	Status — fill in as you collect
NGO Name & Tagline	Name: The Boven Foundation
TagLine: Igniting Minds, Transforming Communities
Mission Statement (1 paragraph)	To close the education gap by providing underserved youth with STEM resources, mentorship, and inclusive learning spaces that unlock their potential.
Vision Statement (1–2 sentences)	To create a future where every child, regardless of gender or background, has equal access to quality STEM education, empowering them to become problem-solvers, innovators, and leaders in their communities.
3–5 Core Values with descriptions		Innovation
We embrace creative solutions to solve educational challenges.
	Integrity
We operate with honesty and transparency in all we do.
	Empowerment
We equip young people to become problem-solvers and leaders.
	Community
We work with communities, not just for them.
	Inclusivity 
Every child deserves a fair chance. We prioritize access for those left behind, regardless of gender or background.

#we would have the fante translation of only the core values beneath it.
'About Us' story paragraph	The Boven's Foundation is a nonprofit organization dedicated to closing the education gap in communities across Ghana where access to quality STEM education is limited. We believe every child deserves the tools and opportunities to excel in science, technology, engineering, and mathematics, regardless of their background or gender.
Starting in Elmina and expanding to other communities facing educational gaps, we provide hands-on learning experiences, mentorship programs, and resources that transform how young people engage with STEM. Through our work, we are not just teaching, we are empowering the next generation of innovators, problem-solvers, and leaders.
Our approach is rooted in collaboration. We work closely with local schools, teachers, parents, and community leaders to ensure our programs meet real needs and create lasting change. From organizing workshops that inspire both boys and girls to improving school facilities, we're committed to making STEM education accessible, inclusive, and impactful. As we grow, we envision building dedicated STEM labs where students can explore, experiment, and discover their potential.
At The Boven's Foundation, we don't just dream of a more equitable future, we're building it, one student, one school, one community at a time.
Hero banner photo	[ ] Not started
About Us section photo	[ ] Not started
Team member names, titles & bios	Alfred Este Boven Fiahagbe – Co-Founder
Senam Boven Fiahagbe - Co-Founder
Elorm Boven Fiahagbe – CFO
Harriet Yayra Boven Fiahagbe - CMO
Team member photos (at least headshots)	Aks later***
2–5 Project write-ups with photos	[ ] Not started
Impact statistics (numbers)	[ ] Not started
Partner logos (if any)	[ ] Not started
Contact email address	thebovenfoundation@gmail.com
Physical address / location	Elmina, Cape Coat, Ghana.
Social media profile links	[ ] Not started
NGO logo file (PNG with transparent background)	 

8. File & Folder Structure
When you create your project in Cursor, you'll have a folder of files. Here's how to organise them. A clean folder structure makes it much easier to find things and avoid errors.

Your Project Folder Structure
my-ngo-website/ │ ├── index.html          ← Your main (and only) HTML file ├── style.css           ← All your CSS styling goes here ├── script.js           ← JavaScript (for the mobile menu etc.) │ ├── images/             ← Folder for all photos and graphics │   ├── hero-bg.jpg │   ├── about-photo.jpg │   ├── team/ │   │   ├── john-doe.jpg │   │   └── jane-smith.jpg │   └── projects/ │       ├── project-1.jpg │       └── project-2.jpg │ └── README.md           ← A text file describing your project (optional)

9. Development Phases (Your Build Plan)
Don't try to build everything at once. Break the work into phases. This approach is used by professional developers and it works.

Phase	What To Build
Phase 1 — Foundation	Set up your folder, create index.html, add the navbar and hero section. Get comfortable with basic HTML and CSS layout.
Phase 2 — Core Sections	Add About Us, Mission & Values, and Our Team sections. Focus on layout using CSS Flexbox or Grid.
Phase 3 — Projects & Impact	Build the Projects section and the Impact statistics section. This is where your NGO's work comes alive.
Phase 4 — Engagement	Add the Partners section, the Call to Action section, and the Contact form using Formspree.
Phase 5 — Polish	Add the footer, make the site look great on mobile phones (responsive design), fix any bugs, and test all links.
Phase 6 — Launch	Publish your site using GitHub Pages or Netlify. Share the link with your team and the world!

How Long Will This Take?
For a complete beginner working a few hours per day, expect: Phase 1 & 2: 3–5 days | Phase 3 & 4: 3–5 days | Phase 5 & 6: 2–3 days. Total: roughly 2–3 weeks of consistent learning and building. Don't rush it!

10. What You Will Learn By Building This
This project is designed to be educational, not just functional. By the time you complete it, you will have real experience with:
•	Writing and structuring HTML documents from scratch
•	Styling pages with CSS including Flexbox, Grid, colors, spacing, and fonts
•	Making websites 'responsive' — meaning they look good on phones AND computers
•	Using JavaScript for basic interactivity (mobile menu toggle)
•	Organising a real software project with proper folder structure
•	Using Git and GitHub to track your code and publish it online
•	Working with a professional AI code editor (Cursor)
•	The complete process of planning, building, and launching a web product

11. Glossary of Terms
Since this is your first time, here are definitions for all the technical words used in this document:

Term	Plain English Definition
HTML	HyperText Markup Language — the language used to define the structure of a web page (headings, paragraphs, images, links).
CSS	Cascading Style Sheets — the language that controls how HTML looks (colors, fonts, spacing, layout).
JavaScript (JS)	A programming language that makes web pages interactive (menus, animations, form validation).
Landing Page	A single, focused web page designed to present information and prompt an action (like contacting or donating).
Responsive Design	Designing a website so it looks and works well on all screen sizes: desktop, tablet, and mobile.
Hero Section	The large, visually striking section at the very top of a page — the first thing visitors see.
CTA (Call to Action)	A button or prompt encouraging the user to take a specific action — like 'Donate Now' or 'Contact Us'.
Navbar / Navigation Bar	The strip at the top of a website containing links to different sections or pages.
Footer	The bottom section of a web page — usually contains contact info, quick links, and copyright.
Flexbox	A CSS layout tool that makes it easy to arrange items in a row or column and control alignment.
Grid	Another CSS layout tool — like a table but much more flexible and powerful.
Hosting	A service that stores your website files on a server so people can access them online.
GitHub Pages	A free hosting service by GitHub where you can publish your website directly from your code repository.
Formspree	A free service that handles contact form submissions without you needing a backend server.
PRD	Product Requirements Document — this document! A detailed plan of what you are building and why.

12. Next Steps
You now have a complete blueprint. Here is exactly what to do next:
1.	Gather your content — Fill in the Content Checklist in Section 7. Don't skip this! Building a website with placeholder text teaches you nothing about your real content.
2.	Open Cursor — Create a new folder called 'my-ngo-website' and set up your file structure as shown in Section 8.
3.	Start with Phase 1 — Just the navbar and hero section. Get comfortable before moving on.
4.	Ask for help — Use Cursor's AI, YouTube, and Claude whenever you're stuck. Nobody builds things alone.
5.	Review this PRD regularly — Come back to it each time you start a new section. It will keep you on track.

You've got this!
Every professional developer was once exactly where you are — reading a plan, feeling unsure, and wondering where to start. The only difference between then and now is that they started. Start small, be consistent, and you'll be amazed at what you build.

— End of Document —
