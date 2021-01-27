<!DOCTYPE html>
<html>
<head>
    <title>Matcha</title>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="stylesheet" href="css/search.css">
</head>
<body>
<div class="header">
  <div class="header-right">
    <a class="active" href="home.php">Home</a>
  <a class="current" href="browseProfile.php">Browse</a>
    <a class="active" href="PublicProfile.php">Profile</a>
    <a class="active" href="Profile_upload.php">Manage Profile</a> 
    <a class="active" href="includes/logout.inc.php">Log Out</a>
  </div>
  <div style="text-align: center; margin: 1%">
    </div>
</div>
<form class="main_one" action="advance_process.php" method="POST">
    <h1>Advanced Search</h1>
		<div class="form-wrap">
			<form method="POST" action="advanced_search.php">
				<h1>Filter Search</h1>
						<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-downr"></i></span>
                <label>Age Between</label>
									<select class="form-control" name="Country">
                    <option disabled>Age Between</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                        <option>32</option>
                        <option>33</option>
                        <option>34</option>
                        <option>35</option>
                        <option>36</option>
                        <option>37</option>
                        <option>38</option>
                        <option>39</option>
                        <option>40</option>
                        <option>41</option>
                        <option>42</option>
                        <option>43</option>
                        <option>44</option>
                        <option>45</option>
                        <option>46</option>
                        <option>47</option>
                        <option>48</option>
                        <option>49</option>
                        <option>50</option>
                        <option>51</option>
                        <option>52</option>
                        <option>53</option>
                        <option>54</option>
                        <option>55</option>
                        <option>56</option>
                        <option>57</option>
                        <option>58</option>
                        <option>59</option>
                        <option>60</option>
                        <option>61</option>
                        <option>62</option>
                        <option>63</option>
                        <option>64</option>
                        <option>65</option>
                        <option>66</option>
                        <option>67</option>
                        <option>68</option>
                        <option>69</option>
                        <option>70</option>
                        <option>71</option>
                        <option>72</option>
                        <option>73</option>
                        <option>74</option>
                        <option>75</option>
                        <option>76</option>
                        <option>77</option>
                        <option>78</option>
                        <option>79</option>
                        <option>80</option>
                        <option>81</option>
                        <option>82</option>
                        <option>83</option>
                        <option>84</option>
                        <option>85</option>
                        <option>86</option>
                        <option>87</option>
                        <option>88</option>
                        <option>89</option>
                        <option>90</option>
                        <option>91</option>
                        <option>92</option>
                        <option>93</option>
                        <option>94</option>
                        <option>95</option>
                        <option>96</option>
                        <option>97</option>
                        <option>98</option>
                        <option>99</option>
                  </select>
                  <br><br>
                  <label>And</label>
                  <select class="form-control" name="Country">
										<option disabled>And</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                        <option>32</option>
                        <option>33</option>
                        <option>34</option>
                        <option>35</option>
                        <option>36</option>
                        <option>37</option>
                        <option>38</option>
                        <option>39</option>
                        <option>40</option>
                        <option>41</option>
                        <option>42</option>
                        <option>43</option>
                        <option>44</option>
                        <option>45</option>
                        <option>46</option>
                        <option>47</option>
                        <option>48</option>
                        <option>49</option>
                        <option>50</option>
                        <option>51</option>
                        <option>52</option>
                        <option>53</option>
                        <option>54</option>
                        <option>55</option>
                        <option>56</option>
                        <option>57</option>
                        <option>58</option>
                        <option>59</option>
                        <option>60</option>
                        <option>61</option>
                        <option>62</option>
                        <option>63</option>
                        <option>64</option>
                        <option>65</option>
                        <option>66</option>
                        <option>67</option>
                        <option>68</option>
                        <option>69</option>
                        <option>70</option>
                        <option>71</option>
                        <option>72</option>
                        <option>73</option>
                        <option>74</option>
                        <option>75</option>
                        <option>76</option>
                        <option>77</option>
                        <option>78</option>
                        <option>79</option>
                        <option>80</option>
                        <option>81</option>
                        <option>82</option>
                        <option>83</option>
                        <option>84</option>
                        <option>85</option>
                        <option>86</option>
                        <option>87</option>
                        <option>88</option>
                        <option>89</option>
                        <option>90</option>
                        <option>91</option>
                        <option>92</option>
                        <option>93</option>
                        <option>94</option>
                        <option>95</option>
                        <option>96</option>
                        <option>97</option>
                        <option>98</option>
                        <option>99</option>
									</select>
							</div><br>
							<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                <label>Filter By Location</label>
									<select class="form-control input-md" name="Gender">
										<option disabled>Select Location</option>
										<option>Cape Town</option>
										<option>Durban</option>
										<option>Johannesburg</option>
                    <option>Pretoria</option>
									</select>
							</div><br>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
            <label>Filter By Interest</label>
              <select class="form-control input-md" name="Gender">
										<option disabled>Select Interest</option>
										<option>Cars</option>
										<option>Music</option>
										<option>Travelling</option>
                    <option>Partying</option>
                    <option>Socializing</option>
										<option>Movies</option>
										<option>Outdoor Vibes</option>
                    <option>Reading</option>
                    <option>Sports</option>
										<option>Adrenalin Junkie</option>
										<option>Reading</option>
                    <option>Indoors</option>
                    <option>Meeting New People</option>
										<option>Business</option>
										<option>Adventure</option>
                    <option>Continuos Learning</option>
							</select>
            </div><br>
				<input type="submit" name="searchadvanced" value="search">
			</form>
			
		</div>

</html>