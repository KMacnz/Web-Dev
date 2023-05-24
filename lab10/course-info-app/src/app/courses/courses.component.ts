import { Component } from '@angular/core';
import { Course } from '../course';
import { COURSES } from '../test-course';

@Component({
  selector: 'app-courses',
  templateUrl: './courses.component.html',
  styleUrls: ['./courses.component.css'],
})
export class CoursesComponent {
  courses = COURSES;

  selectedCourse?: Course;

  onSelect(course: Course): void {
    this.selectedCourse = course;
  }
}
