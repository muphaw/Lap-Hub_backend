// src/data/projects.ts
export interface TeamMember {
  name: string
  avatarUrl: string
}

export interface Project {
  id: string
  studentId: number  // <-- Add this to link to a student
  studentName: string
  studentAvatar: string
  department: string
  teamMembers: TeamMember[]
  imageUrl: string
  title: string
  description: string
  liked: boolean
  views: number
  externalUrl: string
}

export const projects: Project[] = [
  {
    id: '1',
    studentId: 1, // links to Devon Lane (id 1)
    studentName: 'Devon Lane',
    studentAvatar:
      'https://themindfulsteward.com/wp-content/uploads/2018/10/christopher-evans-chri7z-mindful-steward.jpg',
    department: 'business',
    teamMembers: [
      { name: 'Ava', avatarUrl: 'https://randomuser.me/api/portraits/women/1.jpg' },
      { name: 'Leo', avatarUrl: 'https://randomuser.me/api/portraits/men/2.jpg' },
      { name: 'Nia', avatarUrl: 'https://randomuser.me/api/portraits/women/3.jpg' }
    ],
    imageUrl: 'https://tse3.mm.bing.net/th/id/OIP.Rl5UGiiZMvhyUFbuS-o7lQHaFQ?rs=1&pid=ImgDetMain&o=7&rm=3',
    title: 'Awesome Vue Project',
    description: 'A modern dashboard app built with Vue and Tailwind.',
    liked: false,
    views: 39,
    externalUrl: 'https://example.com'
  },
  {
    id: '2',
    studentId: 2, // links to Courtney Henry (id 2)
    studentName: 'Courtney Henery',
    studentAvatar:
      'https://randomuser.me/api/portraits/women/65.jpg',
    department: 'Information Technology',
    teamMembers: [
      { name: 'Max', avatarUrl: 'https://randomuser.me/api/portraits/men/34.jpg' },
      { name: 'Sara', avatarUrl: 'https://randomuser.me/api/portraits/women/22.jpg' }
    ],
    imageUrl: 'https://via.placeholder.com/500x300?text=Project+2',
    title: 'Innovative IT Solution',
    description: 'An innovative project focusing on IT infrastructure and cloud solutions.',
    liked: false,
    views: 27,
    externalUrl: 'https://example2.com'
  }
]
