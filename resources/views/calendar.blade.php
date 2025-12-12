@extends('layouts.navi')

@section('title', 'Calendar - FEU Cavite Alumni Platform')

@section('content')
<div class="content">
    <h2 class="section-title" style="text-align: center; margin-bottom: 30px;">FEU Cavite Events Calendar</h2>
    
    {{-- Calendar Grid --}}
    <div class="calendar-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 30px;">
        
        {{-- Event Card 1 --}}
        <div class="post-box" style="text-align: center;">
            <h3 style="color: #0b6623; margin-bottom: 15px; font-size: 20px;">Alumni Homecoming</h3>
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('images/calendar.png') }}" alt="Alumni Homecoming" style="width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            </div>
            <p style="color: #666; margin-bottom: 10px;"><strong>Date:</strong> December 15, 2024</p>
            <p style="color: #666; font-size: 14px;">Join us for our annual alumni homecoming celebration!</p>
        </div>

        {{-- Event Card 2 --}}
        <div class="post-box" style="text-align: center;">
            <h3 style="color: #0b6623; margin-bottom: 15px; font-size: 20px;">Career Fair</h3>
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('images/calendar.png') }}" alt="Career Fair" style="width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            </div>
            <p style="color: #666; margin-bottom: 10px;"><strong>Date:</strong> January 20, 2025</p>
            <p style="color: #666; font-size: 14px;">Connect with employers and explore career opportunities.</p>
        </div>

        {{-- Event Card 3 --}}
        <div class="post-box" style="text-align: center;">
            <h3 style="color: #0b6623; margin-bottom: 15px; font-size: 20px;">Sports Festival</h3>
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('images/calendar.png') }}" alt="Sports Festival" style="width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            </div>
            <p style="color: #666; margin-bottom: 10px;"><strong>Date:</strong> February 10, 2025</p>
            <p style="color: #666; font-size: 14px;">Annual sports competition for alumni and students.</p>
        </div>

        {{-- Event Card 4 --}}
        <div class="post-box" style="text-align: center;">
            <h3 style="color: #0b6623; margin-bottom: 15px; font-size: 20px;">Networking Night</h3>
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('images/calendar.png') }}" alt="Networking Night" style="width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            </div>
            <p style="color: #666; margin-bottom: 10px;"><strong>Date:</strong> March 5, 2025</p>
            <p style="color: #666; font-size: 14px;">Build connections with fellow alumni and professionals.</p>
        </div>

    </div>

    {{-- Instructions for Adding Pictures --}}
    <div class="post-box" style="background: #f0f7f4; border-left: 4px solid #0b6623; padding: 20px; margin-top: 30px;">
        <h3 style="color: #0b6623; margin-bottom: 15px;">How to Add Pictures to Calendar Events:</h3>
        <ol style="color: #333; line-height: 1.8; padding-left: 20px;">
            <li><strong>Prepare your image:</strong> Save your event picture in the <code>public/images/</code> folder</li>
            <li><strong>Update the image path:</strong> Replace <code>images/calendar.png</code> with your image filename (e.g., <code>images/homecoming2024.jpg</code>)</li>
            <li><strong>Add more events:</strong> Copy one of the event card divs above and customize:
                <ul style="margin-top: 10px; padding-left: 20px;">
                    <li>Change the event title in the <code>&lt;h3&gt;</code> tag</li>
                    <li>Update the image <code>src</code> attribute</li>
                    <li>Modify the date and description</li>
                </ul>
            </li>
            <li><strong>Image recommendations:</strong>
                <ul style="margin-top: 10px; padding-left: 20px;">
                    <li>Optimal size: 300x200px or similar aspect ratio</li>
                    <li>Formats: JPG, PNG, or WebP</li>
                    <li>Keep file sizes reasonable for fast loading</li>
                </ul>
            </li>
        </ol>
    </div>

    {{-- Example: Adding a Custom Event with Different Image --}}
    <div class="post-box" style="margin-top: 20px; background: #fff9e6; border-left: 4px solid #ffc107; padding: 20px;">
        <h4 style="color: #856404; margin-bottom: 10px;">Example: Custom Event with Your Image</h4>
        <pre style="background: #f5f5f5; padding: 15px; border-radius: 5px; overflow-x: auto; font-size: 12px;"><code>&lt;div class="post-box" style="text-align: center;"&gt;
    &lt;h3 style="color: #0b6623; margin-bottom: 15px; font-size: 20px;"&gt;Your Event Name&lt;/h3&gt;
    &lt;div style="margin-bottom: 15px;"&gt;
        &lt;img src="{{ asset('images/your-image.jpg') }}" alt="Your Event" 
             style="width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"&gt;
    &lt;/div&gt;
    &lt;p style="color: #666; margin-bottom: 10px;"&gt;&lt;strong&gt;Date:&lt;/strong&gt; Your Date Here&lt;/p&gt;
    &lt;p style="color: #666; font-size: 14px;"&gt;Your event description here.&lt;/p&gt;
&lt;/div&gt;</code></pre>
    </div>
</div>
@endsection



