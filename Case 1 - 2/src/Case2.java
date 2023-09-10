import java.util.ArrayList;
import java.util.List;

class Comment {
    int commentId;
    String commentContent;
    List<Comment> replies;

    public Comment(int commentId, String commentContent) {
        this.commentId = commentId;
        this.commentContent = commentContent;
        this.replies = new ArrayList<>();
    }

    public void addReply(Comment reply) {
        replies.add(reply);
    }

    public int getTotalComments() {
        int total = 1; // Inisialisasi dengan 1 untuk komentar utama
        for (Comment reply : replies) {
            total += reply.getTotalComments();
        }
        return total;
    }
}

public class Case2 {
    public static void main(String[] args) {
        Comment comment1 = new Comment(1, "Hai");
        Comment reply11 = new Comment(11, "Hai juga");
        Comment reply111 = new Comment(111, "Haai juga hai jugaa");
        Comment reply112 = new Comment(112, "Haai juga hai jugaa");
        reply11.addReply(reply111);
        reply11.addReply(reply112);
        Comment reply12 = new Comment(12, "Hai juga");
        Comment reply121 = new Comment(121, "Haai juga hai jugaa");
        reply12.addReply(reply121);
        comment1.addReply(reply11);
        comment1.addReply(reply12);

        Comment comment2 = new Comment(2, "Halooo");

        List<Comment> comments = new ArrayList<>();
        comments.add(comment1);
        comments.add(comment2);

        // Jawaban untuk soal 5
        System.out.println("Soal 5: Total komentar adalah " + getTotalComments(comments) + " komentar.");
    }

    public static int getTotalComments(List<Comment> comments) {
        int total = 0;
        for (Comment comment : comments) {
            total += comment.getTotalComments();
        }
        return total;
    }
}
