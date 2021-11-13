<p>You've decided to try to <b>{{ $goal->name }}</b></p>
<p>Your approach is to <b>{{ $approach->name }}</b>.</p>
<p>Great choice! Let's make a plan to turn this goal into reality</p>

<form method="POST" action="/plan/save">
  @csrf
<input type="hidden" value="{{$goal->id}}" name="goal_id">
<input type="hidden" value="{{$approach->id}}" name="approach_id">
<p>What is your current {{ $goal->measurement }}?</p>
<input type="text" name="goal_initial" id="measurement" required><br>


<p>How many days do you want to run this experiment for?</p>
<select name="days" required>
    <option value="5">5</option>
    <option value="7">7</option>
    <option value="10">10</option>
    <option value="14">14</option>
  </select>

<p>We will text you everyday to see if you are sticking with the plan.</p> 
<p>What is your phone number?</p>
<input type="tel" id="phone" name="phone_number" pattern="[0-9]{10}" required>
<p>What time do you want to be texted?</p>
<select name="message_time" required>
    <option value="0">12:00 am</option>
    <option value="1">1:00 am</option>
    <option value="2">2:00 am</option>
    <option value="3">3:00 am</option>
    <option value="4">4:00 am</option>
    <option value="5">5:00 am</option>
    <option value="6">6:00 am</option>
    <option value="7">7:00 am</option>
    <option value="8">8:00 am</option>
    <option value="9">9:00 am</option>
    <option value="10">10:00 am</option>
    <option value="11">11:00 am</option>
    <option value="12">12:00 pm</option>
    <option value="13">1:00 pm</option>
    <option value="14">2:00 pm</option>
    <option value="15">3:00 pm</option>
    <option value="16">4:00 pm</option>
    <option value="17">5:00 pm</option>
    <option value="18">6:00 pm</option>
    <option value="19">7:00 pm</option>
    <option value="20">8:00 pm</option>
    <option value="21">9:00 pm</option>
    <option value="22">10:00 pm</option>
    <option value="23">11:00 pm</option>
  </select>
  <p>

<input type="submit" value="Get Started">
</form>  