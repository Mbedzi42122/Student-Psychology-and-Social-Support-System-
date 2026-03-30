# SOFTWARE REQUIREMENTS SPECIFICATION (SRS)
## Student Psychology and Social Support System (SPSS)
---

## 1. INTRODUCTION

### 1.1 Purpose
The purpose of the Student Psychology and Social Support System (SPSS) is to provide a secure, web-based platform that supports student mental health, emotional well-being, and social interaction.

The system enables:
- Early detection of psychological distress  
- Access to counselling services  
- AI-assisted emotional support  
- Peer-to-peer engagement  

This document provides detailed functional and non-functional requirements for developers.

---

### 1.2 Scope
The system will:
- Allow students to access support anonymously or via login  
- Provide AI-driven conversational support  
- Enable counselling requests and scheduling  
- Offer peer support forums  
- Provide curated mental health resources  
- Allow counsellors/admin to monitor and respond to student needs  

⚠️ **Note:** This system does not replace professional therapy, but acts as a support bridge.

---

### 1.3 Definitions

| Term               | Meaning                                    |
|-------------------|--------------------------------------------|
| AI Support Agent   | Chatbot providing emotional assistance     |
| Counsellor        | Professional providing mental health support |
| Anonymous User     | User accessing system without identity    |
| Emotional Detection| NLP-based classification of mental state  |

---

## 2. OVERALL DESCRIPTION

### 2.1 Product Perspective
The system is a web-based application with modular architecture:
- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP / Node.js  
- **AI Module:** Python (NLP model)  
- **Database:** MySQL  

---

### 2.2 System Architecture Overview
**Components:**
1. Client Interface (Frontend)  
2. Application Server (Backend)  
3. AI Processing Module  
4. Database System  

---

### 2.3 User Classes

| User Type  | Description                        |
|-----------|------------------------------------|
| Student   | Primary user seeking help           |
| Counsellor| Provides professional support       |
| Admin     | Manages system operations           |

---

### 2.4 Operating Environment
- Web browsers (Chrome, Edge, Firefox)  
- Mobile responsive interface  
- Hosted on server (e.g., Apache, XAMPP, cloud hosting)  

---

### 2.5 Constraints
- Must comply with data privacy laws  
- Limited African-language datasets for AI  
- Ethical handling of sensitive mental health data  

---

## 3. SYSTEM FEATURES & FUNCTIONAL REQUIREMENTS

### 3.1 User Authentication System
**Description:** Allows secure access to the system.  

**Functional Requirements:**
- FR1.1: Users shall register with email and password  
- FR1.2: Users shall log in securely  
- FR1.3: Passwords shall be encrypted (e.g., bcrypt)  
- FR1.4: System shall allow anonymous access  
- FR1.5: System shall differentiate user roles (Student, Counsellor, Admin)  

---

### 3.2 AI Chat Support System
**Description:** Provides real-time conversational emotional support.  

**Functional Requirements:**
- FR2.1: System shall accept user text input  
- FR2.2: AI shall analyse emotional tone  
- FR2.3: AI shall generate supportive responses  
- FR2.4: AI shall recommend counselling when needed  
- FR2.5: Response time shall be < 3 seconds  

---

### 3.3 Emotional State Detection (Core Module)
**Description:** Analyses user text using NLP.  

**Functional Requirements:**
- FR3.1: System shall classify input into: Stress, Anxiety, Depression (light detection only)  
- FR3.2: System shall store classification results  
- FR3.3: System shall flag high-risk inputs  
- FR3.4: System shall trigger alerts to counsellors  

---

### 3.4 Counselling Request System
**Description:** Allows students to request professional help.  

**Functional Requirements:**
- FR4.1: Students shall submit request forms  
- FR4.2: Students shall select preferred date/time  
- FR4.3: System shall notify counsellors  
- FR4.4: Counsellors shall accept/reject requests  
- FR4.5: System shall store appointment records  

---

### 3.5 Peer Support Forum
**Description:** Platform for student interaction.  

**Functional Requirements:**
- FR5.1: Users shall create posts  
- FR5.2: Users shall comment on posts  
- FR5.3: Users shall react (like/upvote)  
- FR5.4: Admin shall moderate content  
- FR5.5: System shall allow anonymous posting (optional)  

---

### 3.6 Resource Center
**Description:** Provides mental health educational content.  

**Functional Requirements:**
- FR6.1: System shall display articles and videos  
- FR6.2: Content shall be categorized (e.g., stress, exams)  
- FR6.3: Users shall search resources  
- FR6.4: Admin shall upload/manage content  

---

### 3.7 Admin & Counsellor Dashboard
**Description:** Monitoring and system management interface.  

**Functional Requirements:**
- FR7.1: View all user activity  
- FR7.2: View flagged high-risk cases  
- FR7.3: Manage counselling sessions  
- FR7.4: Generate reports (usage, trends)  
- FR7.5: Manage users (activate/deactivate)  

---

## 4. NON-FUNCTIONAL REQUIREMENTS

### 4.1 Security
- NFR1: All user data shall be encrypted  
- NFR2: Role-based access control must be implemented  
- NFR3: Secure session handling (JWT or PHP sessions)  

### 4.2 Performance
- NFR4: System shall support concurrent users  
- NFR5: AI response time < 3 seconds  

### 4.3 Usability
- NFR6: Interface shall be simple and intuitive  
- NFR7: System shall be mobile-friendly  

### 4.4 Reliability
- NFR8: System uptime ≥ 95%  
- NFR9: Automatic database backup  

### 4.5 Privacy & Ethics
- NFR10: Anonymous access must be supported  
- NFR11: System shall include disclaimer:  
  *“This system is not a substitute for professional medical advice.”*  
- NFR12: Sensitive data shall not be shared without consent  

---

## 5. DATABASE REQUIREMENTS (Core Tables)

### Users
| Field        | Type | Description                    |
|-------------|------|--------------------------------|
| user_id     | PK   | Primary key                    |
| name        |      | User name                      |
| email       |      | Email address                  |
| password    |      | Encrypted password             |
| role        |      | student/counsellor/admin       |
| is_anonymous|      | Boolean                        |

### Messages (AI Chat)
| Field           | Description                     |
|-----------------|---------------------------------|
| message_id      | Primary key                     |
| user_id         | Sender                          |
| message_text    | Text content                    |
| detected_emotion| Classified emotion              |
| timestamp       | Time of message                 |

### Counselling Requests
| Field         | Description                     |
|---------------|---------------------------------|
| request_id    | Primary key                     |
| user_id       | Student                         |
| preferred_date| Requested appointment           |
| status        | Pending/Accepted/Rejected       |
| counsellor_id | Assigned counsellor             |

### Forum Posts
| Field     | Description                      |
|-----------|----------------------------------|
| post_id   | Primary key                      |
| user_id   | Author                            |
| content   | Post content                     |
| timestamp | Time of posting                  |

### Comments
| Field      | Description                      |
|------------|----------------------------------|
| comment_id | Primary key                      |
| post_id    | Linked post                      |
| user_id    | Author                            |
| content    | Comment text                     |

### Resources
| Field       | Description                     |
|-------------|---------------------------------|
| resource_id | Primary key                     |
| title       | Resource title                  |
| category    | Topic category                  |
| content_link| Link to file/video              |

---

## 6. SYSTEM WORKFLOW (Example: AI Support)
1. User submits message  
2. Backend sends text to AI module  
3. AI:
   - Classifies emotion  
   - Generates response  
4. System:
   - Stores data  
   - Displays response  
   - Flags high-risk messages  

---

## 7. FUTURE ENHANCEMENTS
- Mobile app (Android/iOS)  
- Integration with university systems  
- Advanced AI trained on African languages (isiZulu, isiNdebele, etc.)  
- Real-time chat with counsellors
